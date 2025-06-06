import VehicleForm from '@/components/vehicle-form';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Veículos',
        href: '/vehicles',
    },
];

export default function Vehicles() {
    const { props } = usePage();
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Veículos" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <VehicleForm id={props.id as number} />
            </div>
        </AppLayout>
    );
}
