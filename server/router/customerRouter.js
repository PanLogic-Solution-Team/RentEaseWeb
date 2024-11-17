import dotenv from 'dotenv';
import  express from 'express';

const router = express();

dotenv.config({
  path: './.env'
});
const PORT = process.env.PORT || 8000;
router.get('/', (req, res) => {
  res.json({ message: 'Welcome to the Customer API!' });
});

router.get('/info', (req, res) => {
  res.json({ data: "500k" });
});

export default router;

