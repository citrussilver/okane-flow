<script setup>
import ArticleTitleSlot from '@/slots/ArticleTitleSlot.vue';
import ArticleSubtitleSlot from '@/slots/ArticleSubtitleSlot.vue';
import { onMounted, reactive, ref, computed } from 'vue';
import SummaryLabel from '@/Components/SummaryLabel.vue';
import Details from '@/Components/Details.vue';
import CustomSvgButton from '@/Components/CustomSvgButton.vue';
import usePokeAPIFetcher from '@/composables/usePokeAPIFetcher.js';
import useAniQuoteFetcher from '@/composables/useAniQuoteFetcher.js';
import { checkIfArrayExistsBool, titleCasetify, isStrExistsOnName } from '@/functions/helpers';
import Skeleton from '@/volt/Skeleton.vue';

const props = defineProps({
  sharedData: {
        type: Object,
        required: true
  },
})

let loadingPokeApi = ref(true);

let pokemonData = reactive({});

let queriedPokemonName = ref('');

const fetchDone = ref(false)

const loadPokeApi = () => {

  loadingPokeApi.value = true;

  const { pokemon, isLoading } = usePokeAPIFetcher();

  fetchDone.value = false;

  setTimeout(() => {

    pokemonData = {...pokemon};

    queriedPokemonName.value = pokemonData.name;

    fetchDone.value = true;

    loadingPokeApi.value = !loadingPokeApi.value;
  }, 3000)
}

const pokemonImg = ref('')


const fetchImg = (url) => {
  return pokemonImg.value = url
}

// for use on showdown gif
const handleImg = (objUrl, target) => {
  
  if(objUrl !== null) {
    return fetchImg(objUrl);
  } else {
    console.log('specified showdown url is falsy!');
    if(target == 'd') {
      return fetchImg(pokemonData.sprites.front_default);
    } else {
      return fetchImg(pokemonData.sprites.front_shiny);
    }
  }
}

let loadingAniQuote = ref(true);

let aniQuoteData = reactive({});

const loadAniQuote = () => {
  const { aniQuote, isLoading } = useAniQuoteFetcher();

  setTimeout(function(){
    
    aniQuoteData = {...aniQuote};

    loadingAniQuote.value = false
  }, 3000);
  
}

// tried to refactor on helpers.js but class styling won't apply
const handleBgColor = (param) => {

switch (param) {
    case 'normal':
        return 'bg-pokedex-normal px-4 rounded-xl';

    case 'fire':
        return 'bg-pokedex-fire px-4 rounded-xl';

    case 'fighting':
        return 'bg-pokedex-fighting px-4 rounded-xl';

    case 'water':
        return 'bg-pokedex-water px-4 rounded-xl';

    case 'flying':
        return 'bg-pokedex-flying px-4 rounded-xl';

    case 'grass':
        return 'bg-pokedex-grass px-4 rounded-xl';

    case 'poison': 
        return 'bg-pokedex-poison px-4 rounded-xl';

    case 'electric': 
        return 'bg-pokedex-electric px-4 rounded-xl';

    case 'ground': 
        return 'bg-pokedex-ground px-4 rounded-xl';

    case 'psychic': 
        return 'bg-pokedex-psychic px-4 rounded-xl';

    case 'rock': 
        return 'bg-pokedex-rock px-4 rounded-xl';
        
    case 'ice': 
        return 'bg-pokedex-ice px-4 rounded-xl';

    case 'bug': 
        return 'bg-pokedex-bug px-4 rounded-xl';

    case 'dragon': 
        return 'bg-pokedex-dragon px-4 rounded-xl';

    case 'ghost': 
        return 'bg-pokedex-ghost px-4 rounded-xl';

    case 'dark': 
        return 'bg-pokedex-dark px-4 rounded-xl';

    case 'steel': 
        return 'bg-pokedex-steel px-4 rounded-xl';

    case 'fairy': 
        return 'bg-pokedex-fairy px-4 rounded-xl';

    case 'stellar': 
        return 'bg-pokedex-stellar px-4 rounded-xl';

    default:
        return 'bg-pokedex-normal px-4 rounded-xl';
}

}

onMounted(() => {
  // loadPokeApi();
  // encountering cors error on deployment site
  // loadAniQuote();
});

</script>

<template>
    <div class="grid-tile">

      <div class="grid-tile-item bg-inbike-dgreen">
        <p class="tile-title">
          <ArticleTitleSlot>
            Random Pokemon
          </ArticleTitleSlot>
        </p>
        <p class="tile-subtitle">
          <ArticleSubtitleSlot>
            powered by PokeAPI
          </ArticleSubtitleSlot>
        </p>
        <div id="pokemon-content">
            <div v-if="loadingPokeApi" class="flex justify-center">
              <div class="spinner">
                  <div></div>
                  <div></div>
              </div>
              <!-- TODO -->
              <!-- <div class="relative">
                <div class="flex justify-center gap-2">
                  <Skeleton width="10rem" height="4rem"></Skeleton>
                  <Skeleton width="10rem" height="4rem"></Skeleton>
                </div>
              </div> -->
            </div>
            <div id="pokemon-dynamic-content-wp" class="flex" v-else>

              <div class="pokemon-data-wp relative">

                <div :class="{ 'animateTr' : fetchDone }" class="pokemon-data-wp-sub flex items-center justify-center gap-2">

                  <!-- left side -->
                  <div id="pokemon-info" class="pokemon-info-wp p-4 text-white">
                    <div class="pokemon-info-wp-all">
                      <div id="pokemon-id">No. {{ pokemonData.id }}</div>
                      <div id="pokemon-name" class="text-2xl">
                        <a 
                          :href="`https://bulbapedia.bulbagarden.net/wiki/${queriedPokemonName}_(Pok%C3%A9mon)`" 
                          target="_blank"
                        >
                          {{ titleCasetify(pokemonData.name) }}
                        </a>
                      </div>
                      <div id="pokemon-types" class="lg:flex lg:gap-1 mt-1">
                        <div v-for="typesData in pokemonData.types" v-if="checkIfArrayExistsBool(pokemonData.types)" class="flex mt-1">
                          <div :class="handleBgColor(typesData.type.name)">{{ titleCasetify(typesData.type.name) }}</div>
                        </div>
                      </div>
                    </div>
                  </div>
    
                  <!-- right side -->
                  <div id="pokemon-sprites" class="flex text-white gap-2">
                    <div>
                      <a 
                        :href="`https://bulbapedia.bulbagarden.net/wiki/${queriedPokemonName}_(Pok%C3%A9mon)`" 
                        target="_blank"
                      >
                        <div class="flex flex-col items-center text-xs">
                          <img :src="fetchImg(pokemonData.sprites.front_default, 'd')" alt="img-front-default">
                          <p>Default</p>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a 
                        :href="`https://bulbapedia.bulbagarden.net/wiki/${queriedPokemonName}_(Pok%C3%A9mon)`" 
                        target="_blank"
                      >
                        <div class="flex flex-col items-center text-xs">
                          <img :src="fetchImg(pokemonData.sprites.front_shiny, 'd')" alt="img-front-default">
                          <p>Shiny</p>
                        </div>
                      </a>
                    </div>
                  </div>

                </div>

              </div>

            </div>
        </div>
        <div id="custom-click-btn" @click="loadPokeApi" class="mt-7 relative">
          <CustomSvgButton/>
        </div>
      </div>
      
      <!-- Maya Accounts -->
      <div 
        class="grid-tile-item blue-1" 
        :class="{ 'maya': isStrExistsOnName(maya.account_nickname, 'Maya'), 'mora' : isStrExistsOnName(maya.account_nickname, 'MoraCash') }"
        v-for="(maya, index) in sharedData.maya_accounts" 
        key="index" 
      >
        <p class="tile-title">
          <ArticleTitleSlot>
            {{ maya.account_nickname }}
          </ArticleTitleSlot>
        </p>
        <p class="tile-subtitle">
            <ArticleSubtitleSlot>
              Last 4 digits: {{ maya.last_4_digits }}
            </ArticleSubtitleSlot>
        </p>
        <Details>
          <SummaryLabel>Balance</SummaryLabel>
          {{ maya.balance_wc }}
        </Details>
      </div>

            <!-- GCash Accounts -->
            <div 
        class="grid-tile-item blue-1" 
        :class="{ 'gcash': isStrExistsOnName(gCash.account_nickname, 'GCash'), 'mora' : isStrExistsOnName(gCash.account_nickname, 'MoraCash') }"
        v-for="(gCash, index) in sharedData.gcash_accounts" 
        key="index" 
      >
        <p class="tile-title">
          <ArticleTitleSlot>
            {{ gCash.account_nickname }}
          </ArticleTitleSlot>
        </p>
        <p class="tile-subtitle">
            <ArticleSubtitleSlot>
              Last 4 digits: {{ gCash.last_4_digits }}
            </ArticleSubtitleSlot>
        </p>
        <Details>
          <SummaryLabel>Balance</SummaryLabel>
          {{ gCash.balance_wc }}
        </Details>
      </div>

      <!-- Savings Accounts -->
      <div 
        class="grid-tile-item" 
        :class="{ 
          'blue-1' : sa.bank_name, 
          'bpi-red' : isStrExistsOnName(sa.bank_abbrev, 'BPI'), 
          'security-bank dark-grey' :  isStrExistsOnName(sa.bank_abbrev, 'SB'), 
          'union-bank' : isStrExistsOnName(sa.bank_abbrev, 'UB')
        }" 
        v-for="(sa, index) in sharedData.savings_accounts" 
        key="index" 
      >
          <p class="tile-title">
            <ArticleTitleSlot>
              {{ sa.bank_name }}
            </ArticleTitleSlot>
          </p>
          <Details>
            <SummaryLabel>Balance</SummaryLabel>
            {{ sa.balance_wc }}
          </Details>
      </div>

      <!-- Credit Cards -->
      <div 
        class="grid-tile-item purple-1" 
        :class="{ 
          'blue-master-card' : isStrExistsOnName(cc.cc_name, 'Blue Mastercard'),
          'liyue-platinum' : isStrExistsOnName(cc.cc_name, 'Platinum'),
          'liyue-gold' : isStrExistsOnName(cc.cc_name, 'Gold')
        }"
        v-for="(cc, index) in sharedData.cc_accounts" 
        key="index" 
      >
        <p class="tile-title">
          <ArticleTitleSlot>
            {{ cc.cc_name }}
          </ArticleTitleSlot>
        </p>
        <p class="tile-subtitle">
            <ArticleSubtitleSlot>
              Last 4 digits: {{ cc.last_4_digits }}
            </ArticleSubtitleSlot>
        </p>
        <Details>
          <SummaryLabel>Available Credit Limit</SummaryLabel>
          {{ cc.avail_credit_limit_wc }}
        </Details>
      </div>

      <!-- <div class="grid-tile-item union-bank" 
        v-for="(shpw, index) in shopeeWalletData" 
        key="index" 
      >
        <p class="tile-title">
          <ArticleTitleSlot>
            ShopeePay Wallet
          </ArticleTitleSlot>
        </p>
        <Details>
          <SummaryLabel>Balance</SummaryLabel>
          {{ shpw.balance }}
        </Details>
      </div> -->

      <!-- Anime Quotes API -->
      <div class="grid-tile-item grid-col-span-2 bg-quincy text-white">
        <p class="tile-title">
          <ArticleTitleSlot>
            Random Anime Quotes
          </ArticleTitleSlot>
        </p>
        <p class="tile-subtitle">
          <ArticleSubtitleSlot>
            powered by Animechan API
          </ArticleSubtitleSlot>
        </p>
        <div id="aniQuote-content">
            <div class="spinner-wrapper" v-if="loadingAniQuote">
              <div class="spinner">
                  <div></div>
                  <div></div>
              </div>
            </div>
            <div class="quote-wrapper" v-else>
              <div id="quote">{{ aniQuoteData.content}}</div>
              <div id="character">{{ aniQuoteData.character.name }}</div>
              <div id="animeTitle">{{ aniQuoteData.anime.name }}</div>
            </div>
        </div>
        <div id="custom-click-btn" @click="loadAniQuote" class="relative">
          <CustomSvgButton />
        </div>
      </div>

    </div>
</template>

<style scoped>
  #main-content {
    opacity: 0;
    animation-name: wrapper-fadein;
    animation-duration: var(--anim-duration);
    animation-fill-mode: var(--anim-fill-mode);
  }

  @keyframes wrapper-fadein {
      to {
          opacity: 1;
      }
  }

  article p {
      font-weight: normal;
  }

  .spoiler {
    position: relative;
    /* background-color: hsl(0,0%,24%); */
    border-radius: 5px;
    /* border: grey dashed 1px; */
    color: hsl(210,9%,91.5%);
    cursor: pointer;
    min-height: 48px;
    padding-left:5px;
  }

  .spoiler::before {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    width: 4px;
    border-radius: 8px;
    background: grey;
  }

  .blue-1 {
    background-color: #3e8ed0;
  }

  .gcash {
    /* rgb(0, 39, 181) */
    background-image: linear-gradient(-269deg, rgb(44, 0, 144) 7%, rgb(44, 0, 144) 17%, rgb(111, 186, 247) 98%);
  }

  .maya {
    /* rgb(0, 39, 181) */
    background-image: linear-gradient(-269deg, rgb(17, 36, 50) 7%, rgb(17, 36, 50) 17%, rgb(117, 238, 165) 98%);
  }

  .mora {
    /* rgb(234, 211, 87) */
    background-image: linear-gradient(-269deg, rgb(177, 123, 50) 7%, rgb(177, 123, 50) 17%, rgb(234, 211, 87) 98%);
  }

  .bpi-red {
    /* #b11116 */
    background-color: #b11116;
  }

  .security-bank {
    background-color: #016cae;
    background-image: linear-gradient(-269deg, rgb(160, 207, 103) 7%, rgb(160, 207, 103) 17%, rgb(1, 108, 174) 98%);
    /* background-image: linear-gradient(to right, #a0cf67 , #016cae); */
  }

  .union-bank {
    background-color: #fd8506;
    background-image: linear-gradient(-269deg, rgb(204, 130, 0) 7%, rgb(204, 130, 0) 17%, rgb(190, 43, 4) 98%);
  }

  .liyue {
    /* rgb(193, 83, 66) */
    background-image: linear-gradient(-269deg, rgb(193, 83, 66) 7%, rgb(193, 83, 66) 17%, rgb(234, 211, 87) 98%);
  }

  .liyue-platinum {
    /* rgb(229, 228, 225) */
    background-image: linear-gradient(-269deg, rgb(193, 83, 66) 7%, rgb(193, 83, 66) 17%, rgb(229, 228, 225) 98%);
  }

  .liyue-gold {
    background-image: linear-gradient(-269deg, rgb(193, 83, 66) 7%, rgb(193, 83, 66) 17%, rgb(255, 230, 136) 98%);
  }

  .blue-master-card {
    background-image: linear-gradient(-269deg, rgb(3, 47, 115) 7%, rgb(3, 47, 115) 17%, rgb(0, 94, 168) 98%);
    /* background-image: linear-gradient(to right, rgb(0, 94, 168) , #f79f14); */
  }

  .purple-1 {
    background-color: #6d5c71;
  }

  .dark-grey {
    color: #303030;
  }

  .grid-tile {
    display: grid;
    gap: 1.5rem;
    grid-template-columns: repeat(4, 1fr);

    /* padding-block: 2rem; */
    /* width: min(95%, 70rem); */
    margin-inline: auto;
  }

  .grid-tile-item {
    padding: 2rem;
    border-radius: 0.3rem;
    /* box-shadow: 2.5rem 3.75rem 3rem 1rem; */
  }

  /* pokemon api grid-tile */
  .grid-tile-item:first-child {
    grid-column: 3/5;
    grid-row-start: 1;
    grid-row-end: 3;
  }

  .grid-tile-item:last-child {    
    grid-row-start: 4;
    grid-row-end: 3;
  }

  .grid-col-span-2 {
    grid-column: span 2;
  }

  .tile-title {
    font-size: 1.6rem;
    color: #fff;
  }

  .tile-subtitle {
    font-size: 0.7rem;
    /* margin-top: -1.25rem; */
    margin-bottom: 1.5rem;
    font-weight: normal;
  }

  /* #aniQuote-content {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
  } */

  #quote::before {
    content: '"'
  }

  #quote::after {
    content: '"'
  }

  #quote {
    font-size: 1.3rem;
    margin-bottom: 1rem;
  }

  #character, #animeTitle {
    text-align: right;
  }

  #character::before {
    content: '\01D116\00A0';
  }

  #animeTitle::before {
    content: 'Anime: ';
  }

  #custom-click-btn {
    /* position: absolute;
    bottom: 1.5rem;
    left: 1.5rem; */
    height: 2.63rem;
    width: 2.63rem;
    background-color: inherit;
    border: dashed orange 1px;
    border-radius: 5px;
    padding: 0.5rem;
    box-shadow: 3px 2px 22px 1px rgba(0, 0, 0, 0.24);
    cursor: pointer;
    /* transition-duration: 1000ms;
    transition-property: transform;
    transition-timing-function: ease-in-out; */
  }

  #custom-click-btn:hover {
    box-shadow: 3px 2px 22px 1px rgba(89, 126, 141, 1);
  }

  #custom-click-btn:active {
    transform: scale(0.9);
  }

  /* details[open] summary ~ * {
    animation: open .5s ease-in-out;
  }

  @keyframes open {
    0%    {opacity: 0; transform: translateX(-10px)}
    100%  {opacity: 1; transform: translateX(0)}
  } */

  .right-padding {
    padding-right: 1.5rem;
  }

  .spinner-wrapper {
    display: flex;  
    justify-content: center;
  }

  .spinner {
    width: 6.25rem;
    height: 6.25rem;
    position: relative;
  }

  .spinner div {
    box-sizing: border-box;
    position: absolute;
    width: 100%;
    height: 100%;
    border: 10px solid transparent;
    border-top-color: rgb(152, 123, 96);
    border-radius: 50%;
    animation: spinnerOne 1.2s linear infinite;
  }

  .spinner div:nth-child(2) {
    border: 10px solid transparent;
    border-bottom-color: rgb(152, 123, 96);
  }

  @keyframes spinnerOne {
    0% { transform: rotate(0deg); border-width: 10px; }
    50% { transform: rotate(180deg); border-width: 1px; }
    100% { transform: rotate(360deg); border-width: 10px; }
  }

  @media all and (max-width: 700px) {

    #main-content {    
      font-size: 1.5rem;
    }

    .tile.is-ancestor {
      margin: 0;
    }

    .grid-tile {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }
  }

  /* 
    Notes
    Made the div wrapper use tailwind utility class relative
    at the same time targeting the descendant div and making it absolute
    and applying the stylings below
  */
  .pokemon-data-wp > div {
    position: absolute; 
    top: 0rem;
    bottom: -3rem;
    opacity: 0;
    animation-delay: 0.85s;
    animation-duration: 0.8s;
    animation-fill-mode: forwards;
  }
  
  /* 
    Notes
    Without height and width, the image shrinks to whatever reason
    the height and width is based on the pokemon sprites standard size 
    of 96x96
  */
  .pokemon-sprites-div-wp-l, .pokemon-sprites-div-wp-r {
    height: 96px; 
    width: 96px;
  }

  .pokemon-data-wp {
    height: 150px;
    width: 500px;
  }

  /* 
    Notes
    Due to absolute positioning, which also means their natural flow is 
    disrupted already, the two divs holding the pokemon sprite
    lines on top of each other, so applying a margin on the left sprite 
    makes more sense here
  */
  .pokemon-sprites-div-wp-r {
    margin-left: 7rem;
  }

  .animateTr {
    animation-name: transition-img;
  }

  @keyframes transition-img {
    to {
        opacity: 1;
        /* adjusted to align beside the texts info */
        bottom: 1rem; 
    }
  }
</style>