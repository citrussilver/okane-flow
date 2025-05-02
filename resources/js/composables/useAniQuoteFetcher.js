import { reactive, ref } from 'vue'

export default function useAniQuoteFetcher() {
    const state = ref([]);

    let aniQuote = reactive({
        content: '',
        anime: {
            id: 0,
            name: '',
            altName: ''
        },
        character: {
            id: 0,
            name: ''
        }
    });

    const isLoading = ref(false);

    const executeFetcher = async () => {
        isLoading.value = true;

        try {

            const proxyCorsFix = 'https://proxy.corsfix.com/?'

            const url = 'https://api.animechan.io/v1/quotes/random';

            const response = await fetch(url);

            if(!response.ok) {
                throw new Error("Could not fetch resource");
            }
            
            const data = await response.json();

            state.value = data.data;

            // resorted to assign one by one due to 
            // doing something like aniQuote = {...state.value}
            // data gets lost when it reaches Vue frontend

            aniQuote.content = state.value.content;
            aniQuote.anime = state.value.anime;
            aniQuote.character = state.value.character;

        } catch (error) {
            console.error(error)
        } finally {
            isLoading.value = false;
        }
    }

    executeFetcher();

    return {
        aniQuote,
        isLoading
    }
}