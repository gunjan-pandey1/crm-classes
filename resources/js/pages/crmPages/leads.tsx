import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { DatePicker } from '@/components/ui/date-picker';
import { useState, useRef, useEffect } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Leads',
    href: '/leads',
  },
];

function DatatableComponent() {
  const tableRef = useRef<HTMLTableElement>(null);
  const exportButtonRef = useRef<HTMLDivElement>(null);
  const exportDropdownRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    // Ensure the table element exists and that simpleDatatables is loaded
    if (
      tableRef.current &&
      (window as any).simpleDatatables &&
      (window as any).simpleDatatables.DataTable
    ) {
      const tableInstance = new (window as any).simpleDatatables.DataTable(
        tableRef.current,
        {
          // Use the Flowbite template markup
          template: (options: any, dom: any) =>
            "<div class='" +
            options.classes.top +
            "'>" +
            "<div class='flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-3 rtl:space-x-reverse w-full sm:w-auto'>" +
            (options.paging && options.perPageSelect
              ? "<div class='" +
                options.classes.dropdown +
                "'>" +
                "<label>" +
                "<select class='" +
                options.classes.selector +
                "'></select> " +
                options.labels.perPage +
                "</label>" +
                "</div>"
              : "") +
            "<button id='exportDropdownButton' type='button' class='flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:w-auto'>" +
            "Export as" +
            "<svg class='-me-0.5 ms-1.5 h-4 w-4' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='none' viewBox='0 0 24 24'>" +
            "<path stroke='currentColor' strokeLinecap='round' strokeLinejoin='round' strokeWidth='2' d='m19 9-7 7-7-7' />" +
            "</svg>" +
            "</button>" +
            "<div id='exportDropdown' class='z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow-sm dark:bg-gray-700' data-popper-placement='bottom'>" +
            "<ul class='p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400' aria-labelledby='exportDropdownButton'>" +
            "<li>" +
            "<button id='export-csv' class='group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white'>" +
            "<svg class='me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' viewBox='0 0 24 24'>" +
            "<path fillRule='evenodd' d='M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Z' clipRule='evenodd' />" +
            "</svg>" +
            "<span>Export CSV</span>" +
            "</button>" +
            "</li>" +
            "<li>" +
            "<button id='export-json' class='group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white'>" +
            "<svg class='me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' viewBox='0 0 24 24'>" +
            "<path fillRule='evenodd' d='M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0-2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z' clipRule='evenodd' />" +
            "</svg>" +
            "<span>Export JSON</span>" +
            "</button>" +
            "</li>" +
            "<li>" +
            "<button id='export-txt' class='group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white'>" +
            "<svg class='me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' viewBox='0 0 24 24'>" +
            "<path fillRule='evenodd' d='M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0-2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z' clipRule='evenodd' />" +
            "</svg>" +
            "<span>Export TXT</span>" +
            "</button>" +
            "</li>" +
            "<li>" +
            "<button id='export-sql' class='group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white'>" +
            "<svg class='me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' viewBox='0 0 24 24'>" +
            "<path d='M12 7.205c4.418 0 8-1.165 8-2.602C20 3.165 16.418 2 12 2S4 3.165 4 4.603c0 1.437 3.582 2.602 8 2.602ZM12 22c4.963 0 8-1.686 8-2.603v-4.404c-.052.032-.112.06-.165.09a7.75 7.75 0 0 1-.745.387c-.193.088-.394.173-.6.253-.063.024-.124.05-.189.073a18.934 18.934 0 0 1-6.3.998c-2.135.027-4.26-.31-6.3-.998-.065-.024-.126-.05-.189-.073a10.143 10.143 0 0 1-.852-.373 7.75 7.75 0 0 1-.493-.267c-.053-.03-.113-.058-.165-.09v4.404C4 20.315 7.037 22 12 22Zm7.09-13.928a9.91 9.91 0 0 1-.6.253c-.063.025-.124.05-.189.074a18.935 18.935 0 0 1-6.3.998c-2.135.027-4.26-.31-6.3-.998-.065-.024-.126-.05-.189-.074a10.163 10.163 0 0 1-.852-.372 7.816 7.816 0 0 1-.493-.268c-.055-.03-.115-.058-.167-.09V12c0 .917 3.037 2.603 8 2.603s8-1.686 8-2.603V7.596c-.052.031-.112.059-.165.09a7.816 7.816 0 0 1-.745.386Z' />" +
            "</svg>" +
            "<span>Export SQL</span>" +
            "</button>" +
            "</li>" +
            "</ul>" +
            "</div>" +
            "</div>" +
            (options.searchable
              ? "<div class='" +
                options.classes.search +
                "'>" +
                "<input class='" +
                options.classes.input +
                "' placeholder='" +
                options.labels.placeholder +
                "' type='search' title='" +
                options.labels.searchTitle +
                "'" +
                (dom.id ? " aria-controls='" + dom.id + "'" : "") +
                ">" +
                "</div>"
              : ""
            ) +
            "<div class='" +
            options.classes.container +
            "'" +
            (options.scrollY.length
              ? " style='height: " + options.scrollY + "; overflow-Y: auto;'"
              : ""
            ) +
            "></div>" +
            "<div class='" +
            options.classes.bottom +
            "'>" +
            (options.paging ? "<div class='" + options.classes.info + "'></div>" : "") +
            "<nav class='" +
            options.classes.pagination +
            "'></nav>" +
            "</div>"
        }
      );

      if (
        exportButtonRef.current &&
        exportDropdownRef.current &&
        (window as any).Dropdown
      ) {
        new (window as any).Dropdown(
          exportDropdownRef.current,
          exportButtonRef.current
        );
      }

      const exportCsvHandler = () => {
        (window as any).simpleDatatables.exportCSV(tableInstance, {
          download: true,
          lineDelimiter: "\n",
          columnDelimiter: ";",
        });
      };

      const exportSqlHandler = () => {
        (window as any).simpleDatatables.exportSQL(tableInstance, {
          download: true,
          tableName: "export_table",
        });
      };

      const exportTxtHandler = () => {
        (window as any).simpleDatatables.exportTXT(tableInstance, {
          download: true,
        });
      };

      const exportJsonHandler = () => {
        (window as any).simpleDatatables.exportJSON(tableInstance, {
          download: true,
          space: 3,
        });
      };

      const csvBtn = document.getElementById("export-csv");
      const sqlBtn = document.getElementById("export-sql");
      const txtBtn = document.getElementById("export-txt");
      const jsonBtn = document.getElementById("export-json");

      csvBtn && csvBtn.addEventListener("click", exportCsvHandler);
      sqlBtn && sqlBtn.addEventListener("click", exportSqlHandler);
      txtBtn && txtBtn.addEventListener("click", exportTxtHandler);
      jsonBtn && jsonBtn.addEventListener("click", exportJsonHandler);

      return () => {
        csvBtn && csvBtn.removeEventListener("click", exportCsvHandler);
        sqlBtn && sqlBtn.removeEventListener("click", exportSqlHandler);
        txtBtn && txtBtn.removeEventListener("click", exportTxtHandler);
        jsonBtn && jsonBtn.removeEventListener("click", exportJsonHandler);
      };
    }
  }, []);

  return (
    <div>
      <table ref={tableRef} id="export-table">
        <thead>
          <tr>
            <th>
              <span className="flex items-center">
                Name
                <svg
                  className="w-4 h-4 ms-1"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke="currentColor"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="m8 15 4 4 4-4"
                  />
                </svg>
              </span>
            </th>
            <th data-type="date" data-format="YYYY/DD/MM">
              <span className="flex items-center">
                Release Date
                <svg
                  className="w-4 h-4 ms-1"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke="currentColor"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="m8 15 4 4 4-4"
                  />
                </svg>
              </span>
            </th>
            <th>
              <span className="flex items-center">
                NPM Downloads
                <svg
                  className="w-4 h-4 ms-1"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke="currentColor"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="m8 15 4 4 4-4"
                  />
                </svg>
              </span>
            </th>
            <th>
              <span className="flex items-center">
                Growth
                <svg
                  className="w-4 h-4 ms-1"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke="currentColor"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="m8 15 4 4 4-4"
                  />
                </svg>
              </span>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr className="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
            <td className="font-medium text-gray-900 whitespace-nowrap dark:text-white">
              Flowbite
            </td>
            <td>2021/25/09</td>
            <td>269000</td>
            <td>49%</td>
          </tr>
        </tbody>
      </table>
      {/* Export controls rendered by the datatable template */}
      <div ref={exportButtonRef} id="exportDropdownButton"></div>
      <div ref={exportDropdownRef} id="exportDropdown"></div>
    </div>
  );
}

export default function Dashboard() {
  const [fromDate, setFromDate] = useState<Date>();
  const [toDate, setToDate] = useState<Date>();

  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title="Leads" />
      <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
        {/* <div className="flex justify-end gap-4 mb-4">
          <DatePicker
            value={fromDate}
            onChange={setFromDate}
            placeholder="From Date"
          />
          <DatePicker
            value={toDate}
            onChange={setToDate}
            placeholder="To Date"
          />
        </div> */}
        <div className="grid auto-rows-min gap-4 md:grid-cols-3">
          {/* <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border">
            <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
          </div>
          <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border">
            <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
          </div>
          <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border">
            <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
          </div> */}
        </div>
        <div className="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 overflow-hidden rounded-xl border md:min-h-min">
          <DatatableComponent />
        </div>
      </div>
    </AppLayout>
  );
}
