<template>
  <div class="dashboard-container">
    <h1>Welcome, {{ studentName }}</h1>

    <div class="dashboard-sections">
      <div class="section action-button">
        <button class="navigation-btn" @click="goToRooster">Naar Rooster</button>
      </div>

      <div class="section action-button">
        <button class="navigation-btn" @click="goToFacturen">Facturen</button>
      </div>

      <div class="section book-lesson">
        <button class="book-lesson-btn" @click="bookLesson">Boek een nieuwe les</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      studentName: '',
      userRole: '',
    };
  },
  mounted() {
    this.loadStudentData();
  },
  methods: {
    loadStudentData() {
      if (window.Laravel && window.Laravel.user) {
        const userData = window.Laravel.user;
        this.studentName = userData.naam || userData.name;
        this.userRole = userData.role;
      } else {
        console.log('User data not found. Redirecting to login page.');
        this.$router.push('/login');
      }
    },
    goToRooster() {
      window.location.href = '/student/schedule';
    },
    goToFacturen() {
      window.location.href = '/facturen';
    },
    bookLesson() {
      window.location.href = '/lessen/create';
    }
}
};
</script>

<style scoped>
.dashboard-container {
  max-width: 800px;
  margin: 0 auto;
  margin-top: 10rem !important;
  padding: 2rem;
  background-color: #f9f9f9;
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  margin-bottom: 2rem;
  color: #333;
}

.dashboard-sections {
  display: grid;
  grid-template-columns: 1fr;
  gap: 2rem;
}

.section {
  padding: 1.5rem;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
}

.navigation-btn, .book-lesson-btn {
  width: 100%;
  padding: 0.75rem;
  font-size: 1.2rem;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.navigation-btn {
  background-color: #28a745;
}

.navigation-btn:hover {
  background-color: #218838;
}

.book-lesson-btn {
  background-color: #007bff;
}

.book-lesson-btn:hover {
  background-color: #0056b3;
}
</style>
