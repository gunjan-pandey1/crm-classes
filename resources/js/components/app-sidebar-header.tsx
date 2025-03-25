import { Breadcrumbs } from '@/components/breadcrumbs';
import { SidebarTrigger } from '@/components/ui/sidebar';
import { type BreadcrumbItem as BreadcrumbItemType } from '@/types';
import { useState, useEffect } from 'react';
import { searchClient } from '@/lib/algolia';
import { InstantSearch, SearchBox, Hits, Configure } from 'react-instantsearch';
import { createPortal } from 'react-dom';

// Hit component to display search results
const Hit = ({ hit }: { hit: { title?: string; name?: string; description?: string; content?: string } }) => (
  <div className="p-3 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
    <h4 className="text-sm font-medium text-gray-900 dark:text-gray-100">{hit.title || hit.name}</h4>
    <p className="text-xs text-gray-500 dark:text-gray-400">{hit.description || hit.content}</p>
  </div>
);

export function AppSidebarHeader({ breadcrumbs = [] }: { breadcrumbs?: BreadcrumbItemType[] }) {
  const [searchOpen, setSearchOpen] = useState(false);
  const [mountNode, setMountNode] = useState(null);

  // Create a portal container for search results
  useEffect(() => {
    // Create the element to mount search results
    const node = document.createElement('div');
    document.body.appendChild(node);
    setMountNode(node as unknown as null);

    // Clean up function
    return () => {
      document.body.removeChild(node);
    };
  }, []);

  return (
    <header className="border-sidebar-border/50 flex h-16 shrink-0 items-center gap-2 border-b px-6 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4">
      <div className="flex items-center justify-between w-full gap-2">
        <div className="flex items-center gap-2">
          <SidebarTrigger className="-ml-1" />
          <Breadcrumbs breadcrumbs={breadcrumbs} />
        </div>
        <div className="relative">
          <InstantSearch searchClient={searchClient} indexName="YOUR_INDEX_NAME">
            <SearchBox
              classNames={{
                root: 'relative',
                form: 'block',
                input: 'w-64 px-4 py-2 text-sm rounded-lg bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-gray-100 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 transition-colors duration-200',
                submitIcon: 'hidden',
                resetIcon: 'hidden',
                loadingIcon: 'absolute right-3 top-2.5 text-gray-400 dark:text-gray-500'
              }}
              placeholder="Search..."
              onFocus={() => setSearchOpen(true)}
              onSubmit={() => setSearchOpen(false)}
            />
            <Configure hitsPerPage={5} />
            
            {/* Search Results Dropdown */}
            {mountNode && searchOpen && createPortal(
              <div 
                className="absolute right-4 top-16 z-50 w-80 max-h-96 overflow-y-auto bg-white dark:bg-gray-900 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700"
                style={{
                  position: 'fixed',
                  top: '4rem'
                }}
              >
                <Hits hitComponent={Hit} />
                <div className="p-2 text-xs text-center text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700">
                  Powered by Algolia
                </div>
              </div>,
              mountNode
            )}
          </InstantSearch>
          
          {/* Search Icon */}
          <div className="absolute right-3 top-2.5 text-gray-400 dark:text-gray-500 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
        </div>
      </div>
    </header>
  );
}