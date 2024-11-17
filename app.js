import express, { json } from 'express';
import color from 'colors';
import cors from 'cors';
import dotenv from 'dotenv';
import Customer from './server/router/customerRouter.js';


 // Load environment variables
dotenv.config({
      path: './.env'
    });
    const PORT = process.env.PORT || 8000;
const app = express();


app.use(express.static('public'));
app.get('/', (req, res) => {
   res.sendFile('index.html', { root: 'public' })   
});


// Routes
app.use("/api/v1/customer", Customer); 
console.log(`\n
      http://localhost:${PORT}/api/v1/customer`.green)

// Export the app
export { app };