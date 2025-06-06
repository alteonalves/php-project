export interface Vehicle {
    id: number;
    vehicle: string;
    brand: string;
    sold: boolean;
    description: string;
    year: number;
}

export interface totalByBrands {
    brand: string;
    total: number;
}

export interface totalByYear {
    year: number;
    total: number;
}

export interface VehicleList {
    vehicles: Vehicle[];
    totalByBrands: totalByBrands[];
    totalByYear: totalByYear[];
}
