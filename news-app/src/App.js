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
    setResult("search?q=business")
  }
  const handleResult3 = () => {
    setResult("search?q=sport")
  }
  const handleResult4 = () => {
    setResult("search?q=政治")
  }
  const handleResult5 = () => {
    setResult("search?q=社会")
  }
  const handleResult6 = () => {
    setResult("search?q=文化")
  }


  return (
    <div className="news-app">
      <div className='logo'>
        <a href='http://xd195459.html.xdomain.jp/react-news/'><img src={iconImage} alt='H-news' /></a>
      </div>
      <div className='btn-container'>
        <input type='text' placeholder='キーワード入力' ref={resultRef} />
        <button className='btn-research' onClick={handleResult}>検索</button>
        <div className='btn-category-container'>
          <button className='btn-category' onClick={handleResult1}>天気</button>
          <button className='btn-category' onClick={handleResult2}>ビジネス</button>
          <button className='btn-category' onClick={handleResult3}>スポーツ</button>
          <button className='btn-category' onClick={handleResult4}>政治</button>
          <button className='btn-category' onClick={handleResult5}>社会</button>
          <button className='btn-category' onClick={handleResult6}>文化</button>
        </div>
      </div>
      <NewsList result={result}/>
    </div>
  );
}

export default App;
