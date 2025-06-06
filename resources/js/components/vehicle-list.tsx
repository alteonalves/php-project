import { apiUrl, globalHeaders } from '@/lib/utils';
import { Vehicle, VehicleList } from '@/types/vehicle';
import { Link, router } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import BarCharts from './dashboard';
import FilterForm from './filter-form';
import { Button } from './ui/button';
import { Table, TableBody, TableCaption, TableCell, TableFooter, TableHead, TableHeader, TableRow } from './ui/table';

export default function () {
    const [data, setData] = useState<VehicleList>({ vehicles: [], totalByYear: [], totalByBrands: [] });
    useEffect(() => {
        const fetchData = async () => {
            const response = await fetch(apiUrl + '/api/vehicles', { headers: globalHeaders() });
            if (!response.ok) {
                return;
            }
            const json: VehicleList = await response.json();
            setData(json);
        };

        fetchData();
    }, []);
    async function gotoEdit(id: number) {
        if (!id) return;
        router.visit('/edit/' + id);
    }
    const { totalByBrands, vehicles, totalByYear } = data;
    return (
        <div className="flex-col items-center justify-center">
            <div className="flex justify-end">
                <Link href="/create">
                    <Button>Adicionar Veículo</Button>
                </Link>
            </div>
            <BarCharts totalByYear={totalByYear} totalByBrands={totalByBrands} />
            <div>
                <FilterForm onUpdate={setData} />
            </div>
            <Table className="text-center">
                <TableCaption />
                <TableHeader>
                    <TableRow>
                        <TableHead className="text-center">Veículo</TableHead>
                        <TableHead className="text-center">Marca</TableHead>
                        <TableHead className="text-center">Ano</TableHead>
                        <TableHead className="text-center">Vendido</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    {vehicles &&
                        vehicles.map((vh: Vehicle) => (
                            <TableRow key={vh.id} onClick={() => gotoEdit(vh.id)}>
                                <TableCell>{vh.vehicle}</TableCell>
                                <TableCell>{vh.brand}</TableCell>
                                <TableCell>{vh.year}</TableCell>
                                <TableCell>{vh.sold ? 'Sim' : 'Não'}</TableCell>
                            </TableRow>
                        ))}
                </TableBody>
                <TableFooter />
            </Table>
        </div>
    );
}
