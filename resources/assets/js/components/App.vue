<template>
 <div>
      <NavBar2/>
     <transition name="router-anim">
         <router-view></router-view>
     </transition>
</div>
</template>

<script>

import NavBar from '../components/NavBar'
import NavBar2 from '../components/NavBar2'

  export default {
      data(){
          return{

          }
      },
      components: {
          NavBar,
          NavBar2,
      }
  }
</script>
<style>
@import url('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
@import url('https://fonts.googleapis.com/css?family=Pacifico');
@import url('https://fonts.googleapis.com/css?family=Dosis|Nunito|Ubuntu');


  html, body {
    height: calc(100% - 50px);
    font-family: 'Ubuntu', sans-serif;

  }

  h1 {
      font-size: 2.5rem;
  }

    .router-anim-enter-active {
        animation: coming .5s;
        animation-delay: .5s;
        opacity: 0;
    }
    .router-anim-leave-active {
        animation: going .5s;
    }

    @keyframes going {
        from {
            transform: translateX(0);

        }
        to {
            transform: translateX(-50px);
            opacity: 0;
        }
    }
    @keyframes coming {
        from {
            transform: translateX(-50px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }


  .page {
    position: fixed !important;
    width: inherit;
  }

  .handwritting {
      font-family: 'Pacifico', cursive;
      font-size: 2.5em;
  }

</style>

