import { brands } from '@/lib/data';
import { apiUrl, globalHeaders } from '@/lib/utils';
import { zodResolver } from '@hookform/resolvers/zod';
import { Link, router } from '@inertiajs/react';
import { useEffect } from 'react';
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { Button } from './ui/button';
import { Form, FormControl, FormField, FormItem, FormLabel, FormMessage } from './ui/form';
import { Input } from './ui/input';
import { Switch } from './ui/switch';

interface FormProps {
    id?: number;
}

const formSchema = z.object({
    brand: z
        .string()
        .min(1, { message: 'Este campo é obrigatório' })
        .refine((x) => brands.includes(x), { message: 'Marca Invalida' }),
    vehicle: z.string().min(1, { message: 'Este campo é obrigatório' }),
    year: z.string().min(1, { message: 'Este campo é obrigatório' }).max(4),
    description: z.string().optional() ?? '',
    sold: z.boolean() ?? false,
});

type VehicleProps = z.infer<typeof formSchema>;

export default function VehicleForm({ id }: FormProps) {
    const form = useForm<VehicleProps>({
        resolver: zodResolver(formSchema),
        defaultValues: {
            brand: '',
            vehicle: '',
            year: new Date().getFullYear().toString(),
            description: '',
            sold: false,
        },
    });

    useEffect(() => {
        if (!id) return;
        const fetchVehicle = async () => {
            const response = await fetch(apiUrl + '/api/vehicles/' + id, { headers: globalHeaders() });
            if (!response.ok) {
                return;
            }
            const vehicle: VehicleProps = await response.json();
            form.reset({
                ...vehicle,
                year: vehicle.year.toString(),
                description: vehicle.description ?? '',
            });
        };
        fetchVehicle();
    }, [form, id]);

    async function deleteVehicle(e: React.MouseEvent<HTMLButtonElement>) {
        e.preventDefault();
        const q = confirm('Deseja deletar esse veículo da base de dados?');
        if (!q) return false;
        if (!id) return false;
        const r = await fetch(apiUrl + '/api/vehicles/' + id, {
            method: 'delete',
            headers: globalHeaders(),
        });
        if (!r.ok) {
            form.setError('root', { type: 'custom', message: 'erro ao deletar o veiculo' });
            return false;
        }
        router.visit('/');
    }

    async function onSubmit(values: VehicleProps) {
        const url = id ? `${apiUrl}/api/vehicles/${id}` : `${apiUrl}/api/vehicles`;
        const method = id ? 'PATCH' : 'POST';
        const r = await fetch(url, {
            method: method,
            body: JSON.stringify(values),
            headers: globalHeaders(),
        });
        if (!r.ok) {
            form.setError('root', { type: 'custom', message: 'Erro ao salvar o formulário' });
            return false;
        }
        router.visit('/');
    }
    return (
        <Form {...form}>
            <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-8">
                <FormField
                    control={form.control}
                    name="vehicle"
                    render={({ field }) => (
                        <FormItem>
                            <FormLabel>Veículo</FormLabel>
                            <FormControl>
                                <Input placeholder="X6" {...field} />
                            </FormControl>
                            <FormMessage />
                        </FormItem>
                    )}
                />
                <FormField
                    control={form.control}
                    name="brand"
                    render={({ field }) => (
                        <FormItem>
                            <FormLabel>Marca</FormLabel>
                            <FormControl>
                                <Input placeholder="BMW" {...field} />
                            </FormControl>
                            <FormMessage />
                        </FormItem>
                    )}
                />
                <FormField
                    control={form.control}
                    name="year"
                    render={({ field }) => (
                        <FormItem>
                            <FormLabel>Ano</FormLabel>
                            <FormControl>
                                <Input placeholder="2025" {...field} />
                            </FormControl>
                            <FormMessage />
                        </FormItem>
                    )}
                />
                <FormField
                    control={form.control}
                    name="description"
                    render={({ field }) => (
                        <FormItem>
                            <FormLabel>Descrição</FormLabel>
                            <FormControl>
                                <Input {...field} />
                            </FormControl>
                            <FormMessage />
                        </FormItem>
                    )}
                />
                <FormField
                    control={form.control}
                    name="sold"
                    render={({ field }) => (
                        <FormItem className="flex flex-row items-center rounded-lg">
                            <FormControl>
                                <Switch checked={field.value} onCheckedChange={field.onChange} className="bg-white" />
                            </FormControl>
                            <div className="space-y-0.5">
                                <FormLabel>Vendido</FormLabel>
                            </div>
                            <FormMessage />
                        </FormItem>
                    )}
                />
                {form.formState.errors?.root && <FormMessage>{form.formState.errors.root.message}</FormMessage>}
                <Button type="button" className="mr-1 cursor-pointer" variant="outline">
                    <Link href="/">Cancelar</Link>
                </Button>
                {id && (
                    <Button type="button" variant="destructive" onClick={deleteVehicle} className="mr-1 cursor-pointer">
                        Deletar
                    </Button>
                )}
                <Button type="submit" className="cursor-pointer">
                    Salvar
                </Button>
            </form>
        </Form>
    );
}
