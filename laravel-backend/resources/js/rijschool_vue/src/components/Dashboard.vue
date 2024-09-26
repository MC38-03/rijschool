<template>
  <div class="dashboard-container">
    <h1>Welcome, {{ studentName }}</h1>

    <div class="dashboard-sections">
      <div class="section upcoming-lessons">
        <h2>Upcoming Lessons</h2>
        <ul v-if="upcomingLessons.length">
          <li v-for="lesson in upcomingLessons" :key="lesson.id" class="lesson-item">
            <div>
              <strong>Date:</strong> {{ formatDate(lesson.date) }} <br>
              <strong>Time:</strong> {{ lesson.time }} <br>
              <strong>Instructor:</strong> {{ lesson.instructor }}
            </div>
          </li>
        </ul>
        <p v-else>No upcoming lessons</p>
      </div>

      <div class="section instructor-info">
        <h2>Your Instructor</h2>
        <div v-if="instructor">
          <p><strong>Name:</strong> {{ instructor.name }}</p>
          <p><strong>Email:</strong> {{ instructor.email }}</p>
          <p><strong>Phone:</strong> {{ instructor.phone }}</p>
        </div>
        <p v-else>No instructor assigned</p>
      </div>

      <div class="section book-lesson">
        <button class="book-lesson-btn" @click="bookLesson">Book a New Lesson</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      studentName: '',
      upcomingLessons: [],
      instructor: null,
    };
  },
  mounted() {
    this.loadStudentData();
  },
  methods: {
    loadStudentData() {
      const userData = JSON.parse(localStorage.getItem('user'));

      if (userData) {
        this.studentName = userData.naam; // Ensure you're using the correct key (e.g., "name" or "naam")

        // Load additional user data like lessons and instructor from localStorage or from an API
        this.upcomingLessons = userData.lessons || []; // Placeholder, replace with actual API call if needed
        this.instructor = userData.instructor || null; // Placeholder, replace with actual API call if needed
      } else {
        // Redirect to login if user data is 
        console.log('User data not found. Redirecting to login page.');
        this.$router.push('/login');
      }
    },
    formatDate(date) {
      const options = { year: "numeric", month: "long", day: "numeric" };
      return new Date(date).toLocaleDateString("en-US", options);
    },
    bookLesson() {
      // Redirect to the lesson booking page
      this.$router.push('/book-lesson');
    },
  },
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

h2 {
  margin-bottom: 1rem;
  color: #333;
}

.lesson-item {
  margin-bottom: 1rem;
}

.book-lesson-btn {
  width: 100%;
  padding: 0.75rem;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.3s;
}

.book-lesson-btn:hover {
  background-color: #0056b3;
}
</style>
