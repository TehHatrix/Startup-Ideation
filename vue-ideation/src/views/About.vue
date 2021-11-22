<template>
  <div class="about">
    <h1>This is an about page</h1>
    <slider-hypo :type="Severity" > </slider-hypo>
  </div>
</template>

<script>
import slider from '@/components/HypothesisSlider'
export default {
  components: {
    'slider-hypo': slider
  }
  
}
</script>
