import React, { useState, useEffect } from 'react'
import axios from 'axios'
import NewsItem from './NewsItem'
import './newsitem.css'

const NewsList = ({ result }) => {
  const [articles, setArticles] = useState([])
  useEffect(() => {
    const getArticles = async () => {
      const API_KEY = "cddd5402a76846ebc0470103ddd93523"
      // const response = await axios.get(`https://gnews.io/api/v4/top-headlines?&country=jp&apikey=${API_KEY}`)
      const response = await axios.get(`https://gnews.io/api/v4/${result}&country=jp&apikey=${API_KEY}`)
      console.log(response)
      setArticles(response.data.articles)
    }
    getArticles()
  },[result])
  return (
    <div className='news-list'>
      {articles.map(article => {
        return (
          <NewsItem
            title={article.title}
            description={article.description}
            url={article.url}
            image={article.image}
          />
        )
      })}
    </div>
  )
}

export default NewsList