import { usePage, router } from '@inertiajs/vue3';
import consts from '@/constants/constants.js';

export const getUser = () => {
    return usePage().props.auth.user;
}

export const getSharedData = () => {
    return usePage().props.global_shared_data;
}

export const deleteRow = (obj, routeStr) => {
    router.delete(route(`${routeStr}.destroy`, obj.id), {
        preserveScroll: true
    })
}

export const roundNumber = (number, decimals) => {
    let newnumber = new Number(number+'').toFixed(parseInt(decimals))
    return parseFloat(newnumber); 
}

export const objPushToArray = (array_param) => {
    let new_array = [];
    for (let key in array_param) {
        if (array_param.hasOwnProperty(key)) {
            new_array.push(array_param[key]);
        }
    }

    return new_array;
}

// optional chainring Elvis operator ECMAScript 2020
// checks if array and array.length are truthy
export const checkIfArrayExists = (param) => {
    return param?.length ? param.length : '0';
}

export const checkIfArrayExistsBool = (param) => {
    return param?.length ? true : false;
}

export const titleCasetify = (param) => {
    return param.replace(/^(.)|\s(.)/g, match => match.toUpperCase());
}

// to properly show date on html datetime-local tag and money balances
export const propsParser = (ref, props) => {
    ref.value = props;
    props = ref.value;
}

export const isStrExistsOnName = (objKey, strParam) => {
    return objKey.includes(strParam) ? true : false;
}