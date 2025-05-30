import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { DatePickerWithRange } from '@/components/ui/date-picker';
import { useState } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard', 
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const [fromDate, setFromDate] = useState<Date>();
    const [toDate, setToDate] = useState<Date>();

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div className="flex justify-end gap-4 mb-4">
                <DatePickerWithRange 
                    fromDate={fromDate}
                    toDate={toDate}
                    onFromDateChange={setFromDate}
                    onToDateChange={setToDate}
                />
                </div>
                <div className="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 overflow-hidden rounded-xl border md:min-h-min">
                
                </div>
            </div>
        </AppLayout>
    );
}
