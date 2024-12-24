import { usePage } from "@inertiajs/vue3";

export function usePermission() {
    const isAdmin = () => {
        const adminRoles = ['admin', 'super admin', 'super-admin'];
        return usePage().props.auth.user.roles?.some(
            (r) => adminRoles.includes(r.toLowerCase())
        );
    };

    const hasRole = (role) =>
        usePage().props.auth.user.roles?.some(
            (r) => r.toLowerCase() === role.toLowerCase()
        );

    const hasPermission = (permission) => {
        if (isAdmin()) return true;
        
        return usePage().props.auth.user.permissions?.some(
            (p) => p.toLowerCase() === permission.toLowerCase()
        );
    };

    return { hasRole, hasPermission };
}
