import './App.css';
import { useState, useRef } from 'react';
import NewsList from './components/NewsList';
import iconImage from "../src/logo.png";

function App() {
  const [result, setResult] = useState("top-headlines?");
  const resultRef = useRef()
  const handleResult = () => {
    const researchResult = resultRef.current.value
    if (researchResult) {
      setResult(`search?q=${researchResult}`)
      resultRef.current.value = null
    }
  }
  const handleResult1 = () => {
    setResult("search?q=天気")
  }
  const handleResult2 = () => {
    setResult("search?q=sports")
  }
  const handleResult3 = () => {
    setResult("search?q=政治")
  }


  return (
    <div className="news-app">
      <div className='logo'>
        <a href='http://xd195459.html.xdomain.jp/react-news/'><img src={iconImage} alt='H-news' /></a>
      </div>
      <input type='text' ref={resultRef} />
      <button onClick={handleResult}>検索</button>
      <button onClick={handleResult1}>天気</button>
      <button onClick={handleResult2}>スポーツ</button>
      <button onClick={handleResult3}>政治</button>
      <NewsList result={result}/>
    </div>
  );
}

export default App;
