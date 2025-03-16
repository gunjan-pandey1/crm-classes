import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Head, Link } from '@inertiajs/react';
import { Activity, Book, BookOpen, Contact, Folder, Headset, LayoutGrid, Mail, Quote, Settings, SquareActivity, Wrench } from 'lucide-react';
import AppLogo from './app-logo';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        url: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Leads',
        url: '/leads',
        icon: Headset,
    },
    {
        title: 'Quotes',
        url: '/quotes',
        icon: Quote,
    },
    {
        title: 'Mail',
        url: '/mail',
        icon: Mail,
    },
    {
        title: 'Activities',
        url: '/activities',
        icon: SquareActivity,
    },
    {
        title: 'Contacts',
        url: '/contacts',
        icon: Contact,
    },
    {
        title: 'Courses',
        url: '/courses',
        icon: Book,
    },
    {
        title: 'Settings',
        url: '/settings',
        icon: Settings,
    },
    {
        title: 'Configuration',
        url: '/configuration',
        icon: Wrench,
    },

];

const footerNavItems: NavItem[] = [
    // {
    //     title: 'Repository',
    //     url: 'https://github.com/laravel/react-starter-kit',
    //     icon: Folder,
    // },
    // {
    //     title: 'Documentation',
    //     url: 'https://laravel.com/docs/starter-kits',
    //     icon: BookOpen,
    // },
];

export function AppSidebar() {
    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href="/dashboard" prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
