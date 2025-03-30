import { Breadcrumbs } from '@/components/breadcrumbs';
import { SidebarTrigger } from '@/components/ui/sidebar';
import { type BreadcrumbItem as BreadcrumbItemType } from '@/types';
import { searchClient } from '@/lib/algolia';
import { InstantSearch, SearchBox, Hits, useInstantSearch } from 'react-instantsearch';
import { useState } from 'react';

function Hit({ hit }: { hit: any }) {
  return (
    <div className="px-4 py-3 border-b border-gray-100 dark:border-gray-700 last:border-b-0 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
      <p className="font-medium text-sm text-gray-900 dark:text-gray-100 truncate">{hit.name}</p>
      <p className="text-xs text-gray-500 dark:text-gray-400 truncate mt-0.5">{hit.email}</p>
    </div>
  );
}

function SearchResults() {
  const { results } = useInstantSearch();
  
  if (!results.__isArtificial && results.nbHits === 0) {
    return null;
  }

  return (
    <div className="absolute z-50 w-full mt-2 bg-white dark:bg-gray-900 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700">
      <div className="max-h-96 overflow-y-auto rounded-lg">
        <Hits 
          hitComponent={Hit}
          classNames={{
            list: 'divide-y divide-gray-100 dark:divide-gray-700',
          }}
        />
      </div>
    </div>
  );
}

export function AppSidebarHeader({ breadcrumbs = [] }: { breadcrumbs?: BreadcrumbItemType[] }) {
  const [query, setQuery] = useState('');

  return (
    <header className="border-sidebar-border/50 flex h-16 shrink-0 items-center gap-2 border-b px-6 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4">
      <div className="flex items-center gap-2">
        <SidebarTrigger className="-ml-1" />
        <Breadcrumbs breadcrumbs={breadcrumbs} />
        <div className="relative ml-4 w-80">
          <InstantSearch indexName="crm_shetty_class" searchClient={searchClient}>
            <SearchBox
              placeholder="Search..."
              onInput={(event) => {
                const target = event.target as HTMLInputElement;
                setQuery(target.value);
              }}
              classNames={{
                root: 'w-full',
                form: 'relative',
                input:
                  'w-full pl-4 pr-10 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-800 transition-all placeholder-gray-400 dark:placeholder-gray-500',
                submitIcon: 'hidden',
                resetIcon: 'absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300',
              }}
            />
            {query.length > 0 && <SearchResults />}
          </InstantSearch>
        </div>
      </div>
    </header>
  );
}