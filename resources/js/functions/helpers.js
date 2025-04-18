import { usePage, router } from '@inertiajs/vue3';

export const getUser = () => {
    return usePage().props.auth.user;
}

export const getSharedData = () => {
    return usePage().props.global_shared_data;
}

export const deleteRow = (obj, routeStr) => {
    if (window.confirm(`"${obj.name}" is going to be deleted. Are you sure?`)) {
        router.delete(route(`${routeStr}.destroy`, obj.id), {
            preserveScroll: true
        })
    }
}

export const roundNumber = (number, decimals) => {
    let newnumber = new Number(number+'').toFixed(parseInt(decimals))
    return parseFloat(newnumber); 
}