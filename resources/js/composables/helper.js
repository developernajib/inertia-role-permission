export function helper() {
    const capitalize = (str) => str ? str.charAt(0).toUpperCase() + str.slice(1) : '';

    return { capitalize };
}