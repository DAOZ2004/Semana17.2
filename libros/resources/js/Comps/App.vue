<template>
  <div class="container">
    <h1>Inventario de Librería</h1>

    <!-- FORMULARIO -->
    <div class="form-card">
      <h2>Registrar Libro</h2>

      <form @submit.prevent="saveBook">
        <input v-model="form.name" placeholder="Nombre del libro" required>
        <input v-model="form.author" placeholder="Autor" required>
        <input v-model="form.editorial" placeholder="Editorial" required>
        <input v-model="form.edition" placeholder="Edición" required>

        <label>Fecha de lanzamiento</label>
        <input type="date" v-model="form.release_date" required>

        <!-- SELECT CATEGORIAS -->
        <select v-model="form.category_id" required>
          <option disabled value="">Seleccione categoría</option>
          <option v-for="cat in categories" :key="cat.id" :value="cat.id">
            {{ cat.name }}
          </option>
        </select>

        <!-- IMAGEN -->
        <input type="file" @change="handleImage" required>

        <button type="submit">Guardar libro</button>
      </form>
    </div>

    <!-- LISTA LIBROS -->
    <h2>Libros registrados</h2>
    <div class="books">
      <div class="book-card" v-for="book in books" :key="book.id">
        <img :src="'/storage/' + book.image">
        <h3>{{ book.name }}</h3>
        <p><b>Autor:</b> {{ book.author }}</p>
        <p><b>Editorial:</b> {{ book.editorial }}</p>
        <p><b>Categoría:</b> {{ book.category.name }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios"

export default {
  data(){
    return{
      books: [],
      categories: [],
      form:{
        name:"",
        author:"",
        editorial:"",
        edition:"",
        release_date:"",
        category_id:"",
        image:null
      }
    }
  },

  mounted(){
    this.getBooks()
    this.getCategories()
  },

  methods:{
    async getBooks(){
      const res = await axios.get("/api/books")
      this.books = res.data
    },

    async getCategories(){
      const res = await axios.get("/api/categories")
      this.categories = res.data
    },

    handleImage(e){
      this.form.image = e.target.files[0]
    },

    async saveBook(){
      let data = new FormData()
      Object.keys(this.form).forEach(key=>{
        data.append(key,this.form[key])
      })

      await axios.post("/api/books",data)

      alert("Libro guardado 😄")
      this.getBooks()
    }
  }
}
</script>

<style>
.container{
  max-width: 900px;
  margin: auto;
  font-family: Arial;
}

h1{
  text-align: center;
  margin: 20px;
}

.form-card{
  background: #f4f4f4;
  padding: 20px;
  border-radius: 10px;
}

input, select{
  width: 100%;
  padding: 10px;
  margin: 8px 0;
}

button{
  background: #2ecc71;
  color: white;
  border: none;
  padding: 12px;
  cursor: pointer;
  width: 100%;
}

.books{
  display: grid;
  grid-template-columns: repeat(3,1fr);
  gap: 15px;
  margin-top: 20px;
}

.book-card{
  background: white;
  padding: 15px;
  border-radius: 10px;
  box-shadow: 0 0 5px #ccc;
}

.book-card img{
  width: 100%;
  height: 200px;
  object-fit: cover;
}
</style>
