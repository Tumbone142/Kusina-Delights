<template>
  <div class="w-10 h-10 bg-yellow-100 rounded-md shadow-md flex items-center justify-center hover:bg-white">
    <a :href="`#`" :aria-label="icon" class="text-lg">
      <i :class="`fab fa-${icon}`"></i>
    </a>
  </div>
</template>

<script>
export default {
  props: {
    icon: {
      type: String,
      required: true
    }
  }
};
</script>
