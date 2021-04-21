<template>
  <div>
    <div class="card w-100">
      <div class="cadr-body">
        <router-link :to="{name: 'bookable', params:{id}}">
          <h5 class="card-title">{{ title }}</h5>
        </router-link>
        <p>{{ description }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: String,
    description: String,
    id: Number,
  },
};
</script>