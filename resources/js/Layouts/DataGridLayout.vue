<script setup>
import ArticleTitleSlot from '@/slots/ArticleTitleSlot.vue';
import ArticleSubtitleSlot from '@/slots/ArticleSubtitleSlot.vue';
import { ref } from 'vue';
import SummaryLabel from '@/Components/SummaryLabel.vue';
import Details from '@/Components/Details.vue';

const props = defineProps({
  sharedData: {
        type: Array,
        required: true
  },
})

let loading = ref(true)
</script>

<template>
    <div class="grid-tile">
      <div 
        class="grid-tile-item blue-1" 
        :class="{ 'gcash': gCash.account_nickname.includes('GCash'), 'mora' : gCash.account_nickname.includes('MoraCash') }"
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
      <div 
        class="grid-tile-item blue-1" 
        :class="{ 'maya': maya.account_nickname.includes('Maya'), 'mora' : maya.account_nickname.includes('MoraCash') }"
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
      <div 
        class="grid-tile-item" 
        :class="{ 
          'blue-1' : sa.bank_name, 
          'bpi-red' : sa.bank_abbrev.includes('BPI'), 
          'security-bank dark-grey' :  sa.bank_abbrev.includes('SB'), 
          'union-bank' : sa.bank_abbrev.includes('UB')
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
      <div 
        class="grid-tile-item purple-1" 
        :class="{ 
          'blue-master-card' : cc.cc_name.includes('Blue Mastercard'),
          'liyue-platinum' : cc.cc_name.includes('Platinum'),
          'liyue-gold' : cc.cc_name.includes('Gold')
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
      <div class="grid-tile-item purple-1">
        <p class="tile-title">
          <ArticleTitleSlot>
            Random Anime Quotes
          </ArticleTitleSlot>
        </p>
        <p class="tile-subtitle">
          <ArticleSubtitleSlot>
            using Animechan API
          </ArticleSubtitleSlot>
        </p>
        <div id="aniQuote-content">
            <div class="spinner-wrapper" v-if="loading">
              <div class="spinner">
                  <div></div>
                  <div></div>
              </div>
            </div>
            <!-- <div class="quote-wrapper" v-else>
              <div id="quote">{{aniQuote.quote}}</div>
              <div id="character">{{aniQuote.character}}</div>
              <div id="animeTitle">{{aniQuote.anime}}</div>
            </div> -->
        </div>
        <div id="custom-button" @click="loadAniQuote">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-click" style="position: absolute;" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <line x1="3" y1="12" x2="6" y2="12" />
            <line x1="12" y1="3" x2="12" y2="6" />
            <line x1="7.8" y1="7.8" x2="5.6" y2="5.6" />
            <line x1="16.2" y1="7.8" x2="18.4" y2="5.6" />
            <line x1="7.8" y1="16.2" x2="5.6" y2="18.4" />
            <path d="M12 12l9 3l-4 2l-2 4l-3 -9" />
          </svg>
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

  .red-1 {
    background-color: #f14668;
  }

  .yellow-1 {
    background-color: #ffe08a;
  }

  .orange-1 {
    background-color: #fd8506;
  }

  .purple-1 {
    background-color: #6d5c71;
  }

  .green-1 {
    background-color: #48c78e;
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

  /* .grid-tile-span-2 {
    grid-column: span 2;
  } */

  .grid-tile-item:nth-child(3), .grid-tile-item:nth-child(5)  {
    grid-column-start: 1;
  }

  .grid-tile-item:last-child {
    /* grid-column-start: 3; */
    grid-column: 3/5;
    grid-row-start: 1;
    grid-row-end: 3;
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

  #custom-button {
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

  #custom-button:hover {
    box-shadow: 3px 2px 22px 1px rgba(89, 126, 141, 1);
  }

  #custom-button:active {
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
    border-top-color: #ad60f5;
    border-radius: 50%;
    animation: spinnerOne 1.2s linear infinite;
  }

  .spinner div:nth-child(2) {
    border: 10px solid transparent;
    border-bottom-color: #ad60f5;
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
</style>