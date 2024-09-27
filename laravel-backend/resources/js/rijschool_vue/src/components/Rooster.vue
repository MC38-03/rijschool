<template>
    <div class="timetable-container">
      <div class="timetable">
        <div class="days">
          <div v-for="day in days" :key="day" class="day">
            <div class="day-header">{{ day }}</div>
            <div class="time-slots">
              <!-- Voor elk tijdslot in de dag -->
              <div
                v-for="slot in slots"
                :key="slot.time"
                class="time-slot"
                @click="addBlock(day, slot.time)"
              >
                <div v-if="getBlock(day, slot.time)" class="block">
                  {{ getBlock(day, slot.time).name }}<br />
                  {{ getBlock(day, slot.time).time }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        // Dagen van de week
        days: ["Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag"],
        // Tijdslots, bijvoorbeeld 8:00-17:00 in blokken van 1 uur
        slots: [
          { time: "08:00 - 09:00" },
          { time: "09:00 - 10:00" },
          { time: "10:00 - 11:00" },
          { time: "11:00 - 12:00" },
          { time: "12:00 - 13:00" },
          { time: "13:00 - 14:00" },
          { time: "14:00 - 15:00" },
          { time: "15:00 - 16:00" },
          { time: "16:00 - 17:00" },
        ],
        // Blokken die toegevoegd zijn
        blocks: [],
      };
    },
    methods: {
      // Voegt een blok toe op een bepaald tijdslot en dag
      addBlock(day, time) {
        const blockName = prompt("Geef een naam voor dit blok:");
        if (blockName) {
          this.blocks.push({ day, time, name: blockName });
        }
      },
      // Haalt het blok op voor een bepaalde dag en tijdslot
      getBlock(day, time) {
        return this.blocks.find((block) => block.day === day && block.time === time);
      },
    },
  };
  </script>
  
  <style scoped>
  .timetable-container {
    display: flex;
    justify-content: center;
    margin-top: 40px;
    padding: 20px;
    background-color: #f4f7f6;
    min-height: 100vh;
  }
  
  .timetable {
    width: 90%;
    max-width: 1200px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }
  
  .days {
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* Verdeel de rooster in 5 gelijke kolommen */
    grid-auto-rows: minmax(100px, auto); /* Stel de hoogte van de rijen in */
    width: 100%;
  }
  
  .day {
    border-right: 1px solid #e0e0e0;
  }
  
  .day-header {
    text-align: center;
    background-color: #4a90e2;
    color: white;
    padding: 15px 10px;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
  }
  
  .time-slots {
    display: flex;
    flex-direction: column;
  }
  
  .time-slot {
    height: 80px; /* Maak de tijdslot korter */
    border-bottom: 1px solid #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    background-color: #f9f9f9;
    transition: background-color 0.3s ease;
  }
  
  .time-slot:hover {
    background-color: #e0f7fa;
  }
  
  .block {
    background-color: #26a69a;
    color: white;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    width: 100%;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  </style>
  