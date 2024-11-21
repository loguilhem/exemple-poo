import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import FormQuestion from './pages/FormQuestion';
import ListQuestions from './pages/ListQuestions';
//import Spinner from

const App = () => {
  

  return (
    <div>
      <Router>
        <Routes>
          <Route path="/" element={<ListQuestions />} />
          <Route path="/addQuestion" element={<FormQuestion />} />
          <Route path="/editQuestion/:id" element={<FormQuestion />} />
        </Routes>
      </Router>
    </div>
  );
};

export default App;