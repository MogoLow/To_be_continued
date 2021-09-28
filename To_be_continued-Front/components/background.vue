<template>
  <div class="stars">
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: radial-gradient(ellipse at bottom, #0d1d31 0%, #0c0d13 100%);
  overflow: hidden;
}

.stars {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 120%;
  transform: rotate(-45deg);
  color: violet;
}

.star {
  --star-color: var(--primary-color);
  --star-tail-length: 6em;
  --star-tail-height: 2px;
  --star-width: calc(var(--star-tail-length) / 6);
  --fall-duration: 9s;
  --tail-fade-duration: var(--fall-duration);
  position: absolute;
  top: var(--top-offset);
  left: 0;
  width: var(--star-tail-length);
  height: var(--star-tail-height);
  color: var(--star-color);
  background: linear-gradient(45deg, currentColor, transparent);
  border-radius: 50%;
  filter: drop-shadow(0 0 6px currentColor);
  transform: translate3d(104em, 0, 0);
  animation: fall var(--fall-duration) var(--fall-delay) linear infinite, tail-fade var(--tail-fade-duration) var(--fall-delay) ease-out infinite;
}
@media screen and (max-width: 750px) {
  .star {
    animation: fall var(--fall-duration) var(--fall-delay) linear infinite;
  }
}
.star:nth-child(1) {
  --star-tail-length: 7.24em;
  --top-offset: 54.75vh;
  --fall-duration: 9.922s;
  --fall-delay: 5.747s;
}
.star:nth-child(2) {
  --star-tail-length: 6.34em;
  --top-offset: 98.14vh;
  --fall-duration: 11.751s;
  --fall-delay: 9.088s;
}
.star:nth-child(3) {
  --star-tail-length: 6.22em;
  --top-offset: 80.08vh;
  --fall-duration: 8.421s;
  --fall-delay: 2.578s;
}
.star:nth-child(4) {
  --star-tail-length: 5.45em;
  --top-offset: 87.72vh;
  --fall-duration: 9.38s;
  --fall-delay: 0.905s;
}
.star:nth-child(5) {
  --star-tail-length: 6.91em;
  --top-offset: 11.14vh;
  --fall-duration: 9.533s;
  --fall-delay: 6.034s;
}
.star:nth-child(6) {
  --star-tail-length: 5.69em;
  --top-offset: 67.05vh;
  --fall-duration: 7.658s;
  --fall-delay: 3.444s;
}
.star:nth-child(7) {
  --star-tail-length: 6.64em;
  --top-offset: 48.84vh;
  --fall-duration: 6.824s;
  --fall-delay: 8.256s;
}
.star:nth-child(8) {
  --star-tail-length: 5.65em;
  --top-offset: 11.4vh;
  --fall-duration: 9.165s;
  --fall-delay: 2.076s;
}
.star:nth-child(9) {
  --star-tail-length: 6.62em;
  --top-offset: 85.16vh;
  --fall-duration: 11.336s;
  --fall-delay: 9.43s;
}
.star:nth-child(10) {
  --star-tail-length: 7.45em;
  --top-offset: 17.24vh;
  --fall-duration: 8.355s;
  --fall-delay: 1.877s;
}
.star:nth-child(11) {
  --star-tail-length: 6.82em;
  --top-offset: 78.33vh;
  --fall-duration: 10.63s;
  --fall-delay: 4.552s;
}
.star:nth-child(12) {
  --star-tail-length: 6.13em;
  --top-offset: 4.35vh;
  --fall-duration: 11.712s;
  --fall-delay: 9.358s;
}
.star:nth-child(13) {
  --star-tail-length: 5.38em;
  --top-offset: 63.81vh;
  --fall-duration: 11.32s;
  --fall-delay: 1.832s;
}
.star:nth-child(14) {
  --star-tail-length: 6.86em;
  --top-offset: 3.87vh;
  --fall-duration: 11.61s;
  --fall-delay: 2.613s;
}
.star:nth-child(15) {
  --star-tail-length: 5.83em;
  --top-offset: 17.96vh;
  --fall-duration: 8.894s;
  --fall-delay: 0.238s;
}
.star:nth-child(16) {
  --star-tail-length: 7.46em;
  --top-offset: 82.78vh;
  --fall-duration: 6.792s;
  --fall-delay: 7.327s;
}
.star:nth-child(17) {
  --star-tail-length: 7.42em;
  --top-offset: 21.17vh;
  --fall-duration: 10.169s;
  --fall-delay: 5.301s;
}
.star:nth-child(18) {
  --star-tail-length: 6.08em;
  --top-offset: 51.83vh;
  --fall-duration: 8.209s;
  --fall-delay: 5.294s;
}
.star:nth-child(19) {
  --star-tail-length: 6.52em;
  --top-offset: 80.54vh;
  --fall-duration: 10.974s;
  --fall-delay: 3.952s;
}
.star:nth-child(20) {
  --star-tail-length: 6.37em;
  --top-offset: 58.63vh;
  --fall-duration: 7.317s;
  --fall-delay: 6.831s;
}
.star:nth-child(21) {
  --star-tail-length: 6.23em;
  --top-offset: 23.94vh;
  --fall-duration: 8.463s;
  --fall-delay: 2.543s;
}
.star:nth-child(22) {
  --star-tail-length: 6.36em;
  --top-offset: 72.14vh;
  --fall-duration: 8.626s;
  --fall-delay: 3.571s;
}
.star:nth-child(23) {
  --star-tail-length: 5.01em;
  --top-offset: 52.75vh;
  --fall-duration: 6.823s;
  --fall-delay: 4.078s;
}
.star:nth-child(24) {
  --star-tail-length: 6.08em;
  --top-offset: 77.13vh;
  --fall-duration: 6.981s;
  --fall-delay: 8.621s;
}
.star:nth-child(25) {
  --star-tail-length: 5.95em;
  --top-offset: 55.47vh;
  --fall-duration: 10.767s;
  --fall-delay: 7.504s;
}
.star:nth-child(26) {
  --star-tail-length: 5.98em;
  --top-offset: 65.77vh;
  --fall-duration: 9.985s;
  --fall-delay: 7.675s;
}
.star:nth-child(27) {
  --star-tail-length: 5.07em;
  --top-offset: 81.13vh;
  --fall-duration: 8.185s;
  --fall-delay: 8.414s;
}
.star:nth-child(28) {
  --star-tail-length: 6.22em;
  --top-offset: 78.34vh;
  --fall-duration: 10.387s;
  --fall-delay: 8.118s;
}
.star:nth-child(29) {
  --star-tail-length: 5.3em;
  --top-offset: 36.99vh;
  --fall-duration: 7.218s;
  --fall-delay: 0.848s;
}
.star:nth-child(30) {
  --star-tail-length: 5.57em;
  --top-offset: 69.52vh;
  --fall-duration: 7.587s;
  --fall-delay: 1.716s;
}
.star:nth-child(31) {
  --star-tail-length: 5.12em;
  --top-offset: 97.73vh;
  --fall-duration: 6.1s;
  --fall-delay: 5.819s;
}
.star:nth-child(32) {
  --star-tail-length: 5em;
  --top-offset: 88.19vh;
  --fall-duration: 11.12s;
  --fall-delay: 5.708s;
}
.star:nth-child(33) {
  --star-tail-length: 6.43em;
  --top-offset: 65.25vh;
  --fall-duration: 10.986s;
  --fall-delay: 0.471s;
}
.star:nth-child(34) {
  --star-tail-length: 6.19em;
  --top-offset: 83.83vh;
  --fall-duration: 6.988s;
  --fall-delay: 5.24s;
}
.star:nth-child(35) {
  --star-tail-length: 6.65em;
  --top-offset: 26.44vh;
  --fall-duration: 7.176s;
  --fall-delay: 6.868s;
}
.star:nth-child(36) {
  --star-tail-length: 6em;
  --top-offset: 22.13vh;
  --fall-duration: 7.047s;
  --fall-delay: 0.431s;
}
.star:nth-child(37) {
  --star-tail-length: 7.28em;
  --top-offset: 80.57vh;
  --fall-duration: 10.462s;
  --fall-delay: 1.252s;
}
.star:nth-child(38) {
  --star-tail-length: 5.48em;
  --top-offset: 60.42vh;
  --fall-duration: 6.736s;
  --fall-delay: 1.6s;
}
.star:nth-child(39) {
  --star-tail-length: 6.36em;
  --top-offset: 12.26vh;
  --fall-duration: 8.991s;
  --fall-delay: 5.586s;
}
.star:nth-child(40) {
  --star-tail-length: 6.39em;
  --top-offset: 95.11vh;
  --fall-duration: 6.231s;
  --fall-delay: 2.584s;
}
.star:nth-child(41) {
  --star-tail-length: 5.42em;
  --top-offset: 68.49vh;
  --fall-duration: 9.862s;
  --fall-delay: 0.757s;
}
.star:nth-child(42) {
  --star-tail-length: 6.78em;
  --top-offset: 14.73vh;
  --fall-duration: 7.525s;
  --fall-delay: 8.81s;
}
.star:nth-child(43) {
  --star-tail-length: 6.65em;
  --top-offset: 18.52vh;
  --fall-duration: 7.089s;
  --fall-delay: 6.19s;
}
.star:nth-child(44) {
  --star-tail-length: 7.02em;
  --top-offset: 39.55vh;
  --fall-duration: 11.905s;
  --fall-delay: 8.992s;
}
.star:nth-child(45) {
  --star-tail-length: 7.47em;
  --top-offset: 42.16vh;
  --fall-duration: 7.263s;
  --fall-delay: 6.317s;
}
.star:nth-child(46) {
  --star-tail-length: 6.23em;
  --top-offset: 11.27vh;
  --fall-duration: 7.855s;
  --fall-delay: 1.513s;
}
.star:nth-child(47) {
  --star-tail-length: 5.21em;
  --top-offset: 92.33vh;
  --fall-duration: 8.546s;
  --fall-delay: 0.571s;
}
.star:nth-child(48) {
  --star-tail-length: 5.54em;
  --top-offset: 8.47vh;
  --fall-duration: 8.847s;
  --fall-delay: 1.821s;
}
.star:nth-child(49) {
  --star-tail-length: 6.97em;
  --top-offset: 66.31vh;
  --fall-duration: 11.488s;
  --fall-delay: 1.554s;
}
.star:nth-child(50) {
  --star-tail-length: 6.29em;
  --top-offset: 98.25vh;
  --fall-duration: 9.454s;
  --fall-delay: 9.111s;
}
.star::before, .star::after {
  position: absolute;
  content: "";
  top: 0;
  left: calc(var(--star-width) / -2);
  width: var(--star-width);
  height: 100%;
  background: linear-gradient(45deg, transparent, currentColor, transparent);
  border-radius: inherit;
  animation: blink 2s linear infinite;
}
.star::before {
  transform: rotate(45deg);
}
.star::after {
  transform: rotate(-45deg);
}

@keyframes fall {
  to {
    transform: translate3d(-30em, 0, 0);
  }
}
@keyframes tail-fade {
  0%, 50% {
    width: var(--star-tail-length);
    opacity: 1;
  }
  70%, 80% {
    width: 0;
    opacity: 0.4;
  }
  100% {
    width: 0;
    opacity: 0;
  }
}
@keyframes blink {
  50% {
    opacity: 0.6;
  }
}
</style>
