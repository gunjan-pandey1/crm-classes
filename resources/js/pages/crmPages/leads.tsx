import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { DatePickerWithRange } from '@/components/ui/date-picker';
import { useState, useEffect, useRef } from 'react';
import { DataTable } from 'simple-datatables';

const DataTableComponent = () => {
  const tableRef = useRef<HTMLTableElement>(null);
  const dataTableRef = useRef<any>(null);
  const [isMobile, setIsMobile] = useState(false);

  useEffect(() => {
    const checkMobile = () => {
      setIsMobile(window.matchMedia("(any-pointer:coarse)").matches);
    };
    checkMobile();
    window.addEventListener('resize', checkMobile);
    return () => window.removeEventListener('resize', checkMobile);
  }, []);

  useEffect(() => {
    if (tableRef.current && DataTable) {
      const initializeTable = () => {
        if (dataTableRef.current) {
          dataTableRef.current.destroy();
        }

        const options: any = {
          rowRender: (row: any, tr: any, _index: number) => {
            // Check if tr and className exist before accessing
            if (tr && typeof tr.className === 'string') {
              tr.className = row.selected ? `${tr.className} selected` : tr.className.replace(' selected', '');
            }
            return tr;
          },
          rowNavigation: !isMobile,
          tabIndex: 1
        };

        dataTableRef.current = new DataTable(tableRef.current!, options);
        dataTableRef.current.data.data.forEach((data: any) => (data.selected = false));

        dataTableRef.current.on("datatable.selectrow", (rowIndex: number, event: Event) => {
          event.preventDefault();
          const row = dataTableRef.current.data.data[rowIndex];
          row.selected = !row.selected;
          dataTableRef.current.update();
        });
      };

      initializeTable();
    }

    return () => {
      if (dataTableRef.current) {
        dataTableRef.current.destroy();
      }
    };
  }, [isMobile]);

  return (
    <table id="selection-table" ref={tableRef}>
      <thead>
        <tr>
          <th>
            <span className="flex items-center">
              Name
              <svg className="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
              </svg>
            </span>
          </th>
          <th data-type="date" data-format="YYYY/DD/MM">
            <span className="flex items-center">
              Release Date
              <svg className="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
              </svg>
            </span>
          </th>
          <th>
            <span className="flex items-center">
              NPM Downloads
              <svg className="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
              </svg>
            </span>
          </th>
          <th>
            <span className="flex items-center">
              Growth
              <svg className="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
              </svg>
            </span>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr className="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
          <td className="font-medium text-gray-900 whitespace-nowrap dark:text-white">Flowbite</td>
          <td>2021/25/09</td>
          <td>269000</td>
          <td>49%</td>
        </tr>
        <tr className="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
          <td className="font-medium text-gray-900 whitespace-nowrap dark:text-white">React</td>
          <td>2013/24/05</td>
          <td>4500000</td>
          <td>24%</td>
        </tr>
        <tr className="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
          <td className="font-medium text-gray-900 whitespace-nowrap dark:text-white">Vue</td>
          <td>2014/24/05</td>
          <td>1200000</td>
          <td>12%</td>
        </tr>
        <tr className="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
          <td className="font-medium text-gray-900 whitespace-nowrap dark:text-white">Svelte</td>
          <td>2015/24/05</td>
          <td>1200000</td>
          <td>12%</td>
        </tr>
        <tr className="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
          <td className="font-medium text-gray-900 whitespace-nowrap dark:text-white">Solid</td>
          <td>2016/24/05</td>
          <td>1200000</td>
          <td>12%</td>
        </tr>
        <tr className="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
          <td className="font-medium text-gray-900 whitespace-nowrap dark:text-white">Lit</td>
          <td>2017/24/05</td>
          <td>1200000</td>
          <td>12%</td>
        </tr>
      </tbody>
    </table>
  );
};

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'leads', 
    href: '/leads',
  },
];

export default function leads() {
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
          <div className="p-4 h-full">
            <DataTableComponent />
          </div>
        </div>
      </div>
    </AppLayout>
  );
}