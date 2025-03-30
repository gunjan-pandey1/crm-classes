import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import { Activity, Book, BookOpen, Contact, Folder, Headset, LayoutGrid, Mail, Quote, Settings, SquareActivity, Wrench } from 'lucide-react';
import AppLogo from './app-logo';

// Icon mapping object
const iconMapping: { [key: string]: any } = {
    LayoutGrid,
    Headset,
    Quote,
    SquareActivity,
    Contact,
    Book,
    Settings,
    Wrench,
};

export function AppSidebar() {
    const { sideBarMenu } = usePage().props as any;
    
    // Convert session menu to NavItem format
    const mainNavItems: NavItem[] = sideBarMenu.menu?.map((item: any) => ({
        title: item.model_name,
        url: `/${item.model_slug}`,
        icon: iconMapping[item.model_icon] || LayoutGrid, // Fallback to LayoutGrid if icon not found
    })) || [];

    const footerNavItems: NavItem[] = [];

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
