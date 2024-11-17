// app.js
import express from 'express';
import cors from 'cors';
import customerRouter from './server/router/customerRouter.js';
import connectToDatabase from './server/Database/databaseConnection.js';
import dotenv from 'dotenv';

dotenv.config();

const app = express();
const port = process.env.PORT || 8000;

app.use(cors());
app.use(express.json());

app.get('/', (req, res) => {
  res.sendFile(__dirname + '/public/index.html');
});

app.use('/api/customer', customerRouter);

connectToDatabase()
  .then(() => {
    console.log(`Connected to database`);
  })
  .catch((err) => {
    console.error('Database connection failed', err);
  });

export default app;
