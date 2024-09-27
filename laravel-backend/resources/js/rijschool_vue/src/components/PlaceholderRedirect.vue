<!-- src/components/PlaceholderRedirect.vue -->
<template>
    <div>
      Redirecting...
    </div>
  </template>
  
  <script>
  export default {
    props: ['redirectTo'], // Pass the URL to redirect to as a prop
    mounted() {
      // Trigger the redirection to the given URL
      window.location.href = this.redirectTo;
    }
  }
  </script>
  