import React, { useState, useEffect } from 'react'
import axios from 'axios'
import NewsItem from './NewsItem'
import './newsitem.css'

const NewsList = () => {
  const [articles, setArticles] = useState([])
  useEffect(() => {
    const getArticles = async () => {
      const result = "travel"
      const response = await axios.get(`https://newsapi.org/v2/everything?q=${result}&sortBy=publishedAt&apiKey=30aa2f9de4d04bfba8683100303d1ec6`)
      console.log(response)
      setArticles(response.data.articles)
    }
    getArticles()
  },[])
  return (
    <div className='news-list'>
      {articles.map(article => {
        return (
          <NewsItem
            title={article.title}
            description={article.description}
            url={article.url}
            urlToImage={article.urlToImage}
          />
        )
      })}
    </div>
  )
}

export default NewsList