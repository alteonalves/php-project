import { apiUrl, globalHeaders } from '@/lib/utils';
import { VehicleList } from '@/types/vehicle';
import { zodResolver } from '@hookform/resolvers/zod';
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { Button } from './ui/button';
import { Form, FormControl, FormField, FormItem, FormLabel, FormMessage } from './ui/form';
import { Input } from './ui/input';

const formSchema = z.object({
    brand: z.string().optional(),
    year: z.string().optional(),
});

type Vehicle = z.infer<typeof formSchema>;

interface Props {
    onUpdate: (data: VehicleList) => void;
}

export default function FilterForm({ onUpdate }: Props) {
    const form = useForm<Vehicle>({
        resolver: zodResolver(formSchema),
        defaultValues: {
            brand: '',
            year: '',
        },
    });

    async function onSubmit(values: Vehicle) {
        const url = `${apiUrl}/api/vehicles?brand=${values.brand}&year=${values.year}`;
        const response = await fetch(url, { headers: globalHeaders() });
        const vehicles: VehicleList = await response.json();
        onUpdate(vehicles);
        form.reset();
    }
    return (
        <Form {...form}>
            <form onSubmit={form.handleSubmit(onSubmit)} className="mb-2 flex flex-row items-center gap-2">
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
                <Button type="submit" className="flex cursor-pointer self-end">
                    Procurar
                </Button>
            </form>
        </Form>
    );
}
