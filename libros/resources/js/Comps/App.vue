<template>
  <div class="container">
    <h1>Librería</h1>

    <!-- FORM -->
    <div class="form">
      <h2>Registrar libro</h2>

      <input v-model="form.nombre" placeholder="Nombre">
      <input v-model="form.autor" placeholder="Autor">
      <input v-model="form.editorial" placeholder="Editorial">
      <input v-model="form.edicion" placeholder="Edición">
      <input type="date" v-model="form.fecha_lanzamiento">

      <select v-model="form.categoria_id">
        <option disabled value="">Seleccione categoría</option>
        <option v-for="cat in categories" :key="cat.id" :value="cat.id">
          {{ cat.name }}
        </option>
      </select>

      <input type="file" @change="handleImage">
      <button @click="saveBook">Guardar libro</button>
    </div>

    <!-- LISTA -->
    <div class="books">
      <div class="card" v-for="book in books" :key="book.id">
        <img :src="'/storage/' + book.image" width="120">
        <h3>{{ book.name }}</h3>
        <p>{{ book.author }}</p>
        <p><b>Categoría:</b> {{ book.category.name }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {

  data(){
    return {
      books:[],
      categories:[],
      form:{
        nombre:'',
        autor:'',
        editorial:'',
        edicion:'',
        fecha_lanzamiento:'',
        categoria_id:'',
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
      const res = await axios.get('/books')
      this.books = res.data
    },

    async getCategories(){
      const res = await axios.get('/categories')
      this.categories = res.data
    },

    handleImage(e){
      this.form.image = e.target.files[0]
    },

    async saveBook(){
      let formData = new FormData()

      formData.append('nombre', this.form.nombre)
      formData.append('autor', this.form.autor)
      formData.append('editorial', this.form.editorial)
      formData.append('edicion', this.form.edicion)
      formData.append('fecha_lanzamiento', this.form.fecha_lanzamiento)
      formData.append('categoria_id', this.form.categoria_id)
      formData.append('image', this.form.image)

      await axios.post('/books', formData)

      alert('Libro guardado ✔️')

      this.getBooks()
    }

  }
}
</script>

<style>
body{
  margin:0;
  background:#440101;
}

/* contenedor */
.container{
  font-family: Arial, Helvetica;
  padding:40px;
  max-width:1200px;
  margin:auto;
  color: white;
}

/* titulos */
.title{
  text-align:center;
  margin-bottom:30px;
}

.subtitle{
  margin-top:40px;
}

/* formulario */
.form-card{
  background:white;
  padding:25px;
  border-radius:12px;
  box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.grid{
  display:grid;
  grid-template-columns:repeat(2,1fr);
  gap:10px;
  margin-bottom:15px;
}

input, select{
  padding:10px;
  border-radius:6px;
  border:1px solid #ccc;
}

button{
  background:#0c014e;
  color:white;
  border:none;
  padding:12px 25px;
  border-radius:8px;
  font-size:16px;
  cursor:pointer;
  transition:0.3s;
}

button:hover{
  background:#633696;
}

/* cards libros */
.books{
  display:flex;
  flex-wrap:wrap;
  gap:20px;
}

.card{
  width:260px;
  background:rgb(0, 0, 0);
  border-radius:12px;
  overflow:hidden;
  box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.card img{
  width:100%;
  height:260px;
  object-fit:cover;
}

.info{
  padding:15px;
}

</style>