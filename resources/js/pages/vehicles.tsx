import VehicleList from '@/components/vehicle-list';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Veículos',
        href: '/vehicles',
    },
];

export default function Vehicles() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Veículos" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <VehicleList />
            </div>
        </AppLayout>
    );
}
