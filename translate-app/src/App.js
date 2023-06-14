import './App.css'
import React, { useState, useRef } from 'react'
import Output from './components/Output'

function App() {
  const inputTextRef = useRef()
  const [inputText, setInputText] = useState("")
  const getInputText = () => {
    const inputTextNow = inputTextRef.current.value
    setInputText(`${inputTextNow}`)
  }
  const clearInputText = () => {
    setInputText("")
    document.querySelector("#input").value = null
  }

  return (
    <div className='container'>
      <Output inputText = {inputText} />
      {/* <textarea id="input" placeholder='内容を入力する' ref={inputTextRef} onInput={getInputText} /> */}
      <textarea id="input" placeholder='日本語／英語を入力してください。' ref={inputTextRef} />
      <div className='btn-container'>
        <button className="btn" onClick={getInputText}>翻訳</button>
        <button className="btn" onClick={clearInputText}>クリア</button>
      </div>
    </div>
  );
}

export default App;
