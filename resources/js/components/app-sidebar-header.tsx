import { Breadcrumbs } from '@/components/breadcrumbs';
import { SidebarTrigger } from '@/components/ui/sidebar';
import { type BreadcrumbItem as BreadcrumbItemType } from '@/types';

export function AppSidebarHeader({ breadcrumbs = [] }: { breadcrumbs?: BreadcrumbItemType[] }) {
    return (
        <header className="border-sidebar-border/50 flex h-16 shrink-0 items-center gap-2 border-b px-6 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4">
            <div className="flex items-center gap-2">
                <SidebarTrigger className="-ml-1" />
                <Breadcrumbs breadcrumbs={breadcrumbs} />
                <div className="relative ml-4">
                <input
                    type="search"
                    className="mx-auto w-64 px-4 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Search..."
                    onChange={(e) => {
                    // Debounce the search input
                    const searchTerm = e.target.value;
                    // if (searchTerm.length >= 3) {
                    //     fetch(`/api/search?q=${encodeURIComponent(searchTerm)}`, {
                    //     method: 'GET',
                    //     headers: {
                    //         'Content-Type': 'application/json',
                    //     },
                    //     })
                    //     .then((response) => response.json())
                    //     .then((data) => {
                    //         // Handle the Elasticsearch response data
                    //         console.log('Search results:', data);
                    //         // You can update your state here with the search results
                    //     })
                    //     .catch((error) => {
                    //         console.error('Error searching:', error);
                    //     });
                    // }
                    }}
                />
                <div className="absolute right-3 top-2.5 text-gray-400">
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    className="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    >
                    <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth={2}
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    />
                    </svg>
                </div>
                </div>
            </div>
        </header>
    );
}