<template>
  <div>
    <p>Depression Types</p>

    <table>
      <thead>
        <tr>
          <th>Type</th>
          <th>Message</th>
          <th>Range Start</th>
          <th>Range End</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="t in data.depressionTypes" :key="t.id">
          <td>
            <nuxt-link :to="'/types/' + t.id">{{ `${t.type}` }}</nuxt-link>
          </td>
          <td>{{ t.message }}</td>
          <td>{{ t.scoreRangeStart }}</td>
          <td>{{ t.scoreRangeEnd }}</td>
          <td>
            <button class="action-btn view" @click="viewTaker(t.id)">View</button>
            <button class="action-btn edit" @click="editTaker(t.id)">Edit</button>
            <button class="action-btn delete" @click="deleteTaker(t.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  async setup() {
    try {
      const { data } = await useFetch('http://127.0.0.1:8000/api/depression-types');

      definePageMeta({
        layout: 'admin-layout',
      });

      return { data };
    } catch (error) {
      console.error('Error fetching:', error);
      // You might want to handle errors more gracefully, for example by showing an error message to the user
    }
  },

};
</script>

<style>
/* Add your table styles here if needed */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}

/* Add the following style for limiting the maximum width of the "Message" column */
td:nth-child(2) {
  max-width: 200px; /* You can adjust the value based on your preference */
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.action-btn {
  margin-right: 5px;
  padding: 3px 8px;
  cursor: pointer;
  border: none;
  border-radius: 4px;
}

.view {
  background-color: green;
  color: white;
}

.edit {
  background-color: yellow;
  color: #333;
}

.delete {
  background-color: red;
  color: white;
}
</style>
