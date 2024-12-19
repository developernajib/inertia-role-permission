import { usePage } from "@inertiajs/vue3";

export function usePermission() {
    const hasRole = (role) =>
        usePage().props.auth.user.roles?.some(
            (r) => r.toLowerCase() === role.toLowerCase()
        );

    const hasPermission = (permission) =>
        usePage().props.auth.user.permissions?.some(
            (p) => p.toLowerCase() === permission.toLowerCase()
        );

    return { hasRole, hasPermission };
}
