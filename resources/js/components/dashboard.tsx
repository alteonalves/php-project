import { totalByBrands, totalByYear } from '@/types/vehicle';
import { BarElement, CategoryScale, Chart as ChartJS, Legend, LinearScale, Title, Tooltip } from 'chart.js';
import { Bar } from 'react-chartjs-2';

type Props = {
    totalByBrands: totalByBrands[];
    totalByYear: totalByYear[];
};

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend);

export default function BarCharts({ totalByBrands, totalByYear }: Props) {
    if (!totalByBrands || !totalByYear) return <></>;
    const brandChartData = {
        labels: totalByBrands.map((item) => item.brand),
        datasets: [
            {
                label: 'Total por Marca',
                data: totalByBrands.map((item) => item.total),
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderRadius: 6,
            },
        ],
    };

    const yearChartData = {
        labels: totalByYear.map((item) => item.year.toString()),
        datasets: [
            {
                label: 'Total por Ano',
                data: totalByYear.map((item) => item.total),
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderRadius: 6,
            },
        ],
    };

    const options = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            },
            title: {
                display: true,
                text: '',
                font: { size: 18 },
                color: '#fff',
            },
        },
    };

    return (
        <div className="mb-4 flex h-1/2 w-full flex-row gap-6">
            <div className="w-1/2">
                <Bar
                    data={brandChartData}
                    options={{ ...options, plugins: { ...options.plugins, title: { ...options.plugins.title, text: 'Total por Marca' } } }}
                />
            </div>

            <div className="w-1/2">
                <Bar
                    data={yearChartData}
                    options={{ ...options, plugins: { ...options.plugins, title: { ...options.plugins.title, text: 'Total por Ano' } } }}
                />
            </div>
        </div>
    );
}
