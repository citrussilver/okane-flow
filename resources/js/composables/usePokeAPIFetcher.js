import { reactive, ref } from 'vue';

export default function usePokeAPIFetcher() {
    const state = ref([]);
    const pokemon = reactive({
        id: 0,
        name: '',
        sprites: {
          front_default: '',
          front_shiny: '',
          other: {
            showdown: {
                front_default: '',
                front_shiny: ''
            }
          }
        },
        types: [],
        past_types: []
    });

    const isLoading = ref(false);

    const randomize = () => {
        return 1 + Math.random() * 1025 | 0;
    }

    const executeFetcher = async () => {
        isLoading.value = true;
        
        try {

            const url = `https://pokeapi.co/api/v2/pokemon/${randomize()}`;

            const response = await fetch(url);

            if(!response.ok) {
                throw new Error("Could not fetch resource");
            }

            const data = await response.json();

            state.value = data;

            pokemon.id = state.value.id;
            pokemon.name = state.value.name;
            pokemon.sprites.front_default = state.value.sprites.front_default;
            pokemon.sprites.front_shiny = state.value.sprites.front_shiny;
            pokemon.types = state.value.types;
            pokemon.past_types = state.value.past_types;

        } catch (error) {
            console.error(error)
        } finally {
            isLoading.value = false;
        }
    }

    executeFetcher();

    return {
        pokemon,
        isLoading
    }
}