import { type ClassValue, clsx } from 'clsx';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export function globalHeaders() {
    return {
        Accept: 'application/json',
        'Content-Type': 'application/json',
    };
}

export const apiUrl = import.meta.env.VITE_API_URL || 'http://localhost:8000';
