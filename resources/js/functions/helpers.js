import { usePage, router } from '@inertiajs/vue3';

export const getUser = () => {
    return usePage().props.auth.user;
}

export const getSharedData = () => {
    return usePage().props.global_shared_data;
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

// Function to convert a Date object into a format compatible with `datetime-local`
export const formatDateTimeForInput = (date) => {
  const localDate = new Date(date);
  
  const year = localDate.getFullYear();
  const month = String(localDate.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
  const day = String(localDate.getDate()).padStart(2, '0');
  const hours = String(localDate.getHours()).padStart(2, '0');
  const minutes = String(localDate.getMinutes()).padStart(2, '0');

  return `${year}-${month}-${day}T${hours}:${minutes}`;
};