
import  express from 'express';

const router = express();


router.get('/', (req, res) => {
  res.json({ message: 'Welcome to the Customer API!' });
});

router.get('/info', (req, res) => {
  res.json({ data: "500k" });
});

export default router;

