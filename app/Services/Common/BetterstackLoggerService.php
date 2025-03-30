<?php

namespace App\Services\Common;

use Throwable;
use Monolog\Level;
use Monolog\Logger;
use Illuminate\Support\Facades\Log;
use Logtail\Monolog\LogtailHandlerBuilder;

class BetterstackLoggerService
{
    private static ?Logger $logger = null;

    private static function getLogger(): Logger
    {
        $sourceToken = config('services.betterstack.source_token');
        $endpoint = config('services.betterstack.endpoint');

        if (self::$logger === null) {
            self::$logger = new Logger('Crm-logs');
            
            if (!$sourceToken) {
                throw new \RuntimeException('Betterstack source token is not configured');
            }
            
            $handler = LogtailHandlerBuilder::withSourceToken($sourceToken)
                ->withEndpoint($endpoint)
                ->build();
                
            self::$logger->pushHandler($handler);
        }
        
        return self::$logger;
    }

    public static function info(string $message, array $context = [], ?array $userContext = null): void
    {
        self::log($message, Level::Info->value, $context, $userContext);
    }
    
    public static function error(string $message, array $context = [], ?array $userContext = null): void
    {
        self::log($message, Level::Error->value, $context, $userContext);
    }

    public static function warning(string $message, array $context = [], ?array $userContext = null): void
    {
        self::log($message, Level::Warning->value, $context, $userContext);
    }

    public static function critical(string $message, array $context = [],?array $userContext = null): void
    {
        self::log($message, Level::Critical->value, $context, $userContext);
    }
    
    public static function exception(Throwable $exception, array $context = [], ?array $userContext = null): void
    {
        try {
            $context['exception'] = [
                'message' => $exception->getMessage(),
                'code'    => $exception->getCode(),
                'file'    => $exception->getFile(),
                'line'    => $exception->getLine(),
                'trace'   => $exception->getTraceAsString()
            ];
            self::log($exception->getMessage(), Level::Critical->value, $context, $userContext);
        } catch (\Exception $e) {
           
        }
    }
    
    private static function log(string $message, int|string $level, array $context = [], ?array $userContext = null): void
    {
        try {
            $logger = self::getLogger();
            Log::info('Logging message to Betterstack', [
               'message' => $message,
                'level'   => $level,
                'context' => $context
            ]);
            // Optionally add user context if available
            if ($userContext) {
                $context['user'] = $userContext;
            }
            $logger->log($level, $message, $context);
        } catch (\Exception $e) {
            // Silent fail to avoid disrupting main functionality
            $errorData = [
                'message' => $message,
                'level'   => $level,
                'context' => $context,
                'error'   => [
                    'message' => $e->getMessage(),
                    'code'    => $e->getCode(),
                    'file'    => $e->getFile(),
                    'line'    => $e->getLine(),
                    'trace'   => $e->getTraceAsString()
                ]
            ];
            $logger->log(Level::Critical->value, 'Error logging message to Betterstack', $errorData);
        }
    }
}
