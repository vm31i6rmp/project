import React from 'react'
import './newsitem.css'

const NewsItem = ({ title, description, url, image }) => {
  return (
      <div className='news-item'>
        <img className='news-img' src={image} alt={image} />
        <h3><a href={url}>{title}</a></h3>
        <p>{description}</p>
      </div>
  )
}

export default NewsItem