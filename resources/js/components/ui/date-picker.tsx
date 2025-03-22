import * as React from "react";
import { format } from "date-fns";
import { Calendar as CalendarIcon } from "lucide-react";
import { cn } from "@/lib/utils";
import { Button } from "@/components/ui/button";
import { Calendar } from "@/components/ui/calendar";
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from "@/components/ui/popover";

interface DatePickerProps {
  value?: Date;
  onChange?: (date?: Date) => void;
  placeholder?: string;
}

export function DatePicker({ value, onChange, placeholder }: DatePickerProps) {
  return (
    <Popover>
      <PopoverTrigger asChild>
        <Button
          variant="ghost" 
          className="flex items-center gap-2 text-gray-300 hover:bg-transparent hover:text-white p-0"
        >
          <CalendarIcon className="h-5 w-5" />
          <span>{value ? format(value, "PPP") : placeholder}</span>
        </Button>
      </PopoverTrigger>
      <PopoverContent 
        className="p-0 bg-[#0f172a] border-none w-auto shadow-lg" 
        align="end"
      >
        <div className="p-3">
          <div className="text-center mb-2 text-white font-medium">
            March 2025
          </div>
          <div className="grid grid-cols-7 gap-1 text-xs mb-1 text-center">
            <div className="text-gray-400">Su</div>
            <div className="text-gray-400">Mo</div>
            <div className="text-gray-400">Tu</div>
            <div className="text-gray-400">We</div>
            <div className="text-gray-400">Th</div>
            <div className="text-gray-400">Fr</div>
            <div className="text-gray-400">Sa</div>
          </div>
          <div className="grid grid-cols-7 gap-1 text-center">
            {[23, 24, 25, 26, 27, 28, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 1, 2, 3, 4, 5].map((day, index) => (
              <button
                key={index}
                className={cn(
                  "h-8 w-8 rounded-full text-sm flex items-center justify-center",
                  "hover:bg-gray-700 text-white",
                  day === 26 && "bg-blue-600"
                )}
                onClick={() => {
                  const today = new Date();
                  const selectedDate = new Date(2025, 2, day < 23 ? day : day > 31 ? day - 31 : day);
                  onChange?.(selectedDate);
                }}
              >
                {day}
              </button>
            ))}
          </div>
        </div>
      </PopoverContent>
    </Popover>
  );
}