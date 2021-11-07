<template>
  <div>
    <div class="loader loader-14">
      <div class="stars">
        <svg
          width="20px"
          height="20px"
          aria-hidden="true"
          focusable="false"
          data-prefix="fas"
          data-icon="star"
          class="svg-inline--fa fa-star loader-star star-small"
          role="img"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 576 512"
        >
          <path
            fill="currentColor"
            d="M316.7 17.8l65.43 132.4l146.4 21.29c26.27 3.796 36.79 36.09 17.75 54.59l-105.9 102.1l25.05 145.5c4.508 26.31-23.23 45.9-46.49 33.7L288 439.6l-130.9 68.7C133.8 520.5 106.1 500.9 110.6 474.6l25.05-145.5L29.72 226.1c-19.03-18.5-8.516-50.79 17.75-54.59l146.4-21.29l65.43-132.4C271.1-6.083 305-5.786 316.7 17.8z"
          ></path>
        </svg>
        <svg
          width="20px"
          height="20px"
          aria-hidden="true"
          focusable="false"
          data-prefix="fas"
          data-icon="star"
          class="svg-inline--fa fa-star loader-star star-big"
          role="img"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 576 512"
        >
          <path
            fill="currentColor"
            d="M316.7 17.8l65.43 132.4l146.4 21.29c26.27 3.796 36.79 36.09 17.75 54.59l-105.9 102.1l25.05 145.5c4.508 26.31-23.23 45.9-46.49 33.7L288 439.6l-130.9 68.7C133.8 520.5 106.1 500.9 110.6 474.6l25.05-145.5L29.72 226.1c-19.03-18.5-8.516-50.79 17.75-54.59l146.4-21.29l65.43-132.4C271.1-6.083 305-5.786 316.7 17.8z"
          ></path>
        </svg>
      </div>
    </div>
  </div>
</template>

<style scoped>
/*Rating Star*/

.stars {
  color: #e67100;
}

.loader-14 .loader-star {
  position: absolute;
}

.star-small {
  -webkit-animation: star-small-pulse 1s ease-in-out alternate infinite;
  animation: star-small-pulse 1s ease-in-out alternate infinite;
}

.loader-14 .star-big {
  -webkit-animation: star-big-pulse 2s -0.2s ease-in-out infinite;
  animation: star-big-pulse 2s -0.2s ease-in-out infinite;
}

/* ----------------     KEYFRAMES    ----------------- */

@-webkit-keyframes star-big-pulse {
  0% {
    -webkit-transform: scale(0);
    transform: scale(0);
    opacity: 1;
  }
  100% {
    -webkit-transform: scale(3);
    transform: scale(3);
    opacity: 0;
  }
}

@keyframes star-big-pulse {
  0% {
    -webkit-transform: scale(0);
    transform: scale(0);
    opacity: 1;
  }
  100% {
    -webkit-transform: scale(3);
    transform: scale(3);
    opacity: 0;
  }
}

@-webkit-keyframes star-small-pulse {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }
  100% {
    -webkit-transform: scale(1.5);
    transform: scale(1.5);
  }
}

@keyframes star-small-pulse {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }
  100% {
    -webkit-transform: scale(1.5);
    transform: scale(1.5);
  }
}
</style>