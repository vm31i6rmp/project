import { useState, useEffect } from 'react'
import { Category, PostItem } from './interface'
import { createPosts } from './getAsyncPosts'

// Appに必要な情報をまとめて渡す。非同期処理のための副作用フックも含んでいる。

interface getPostsProps {
  isLoading: boolean
  textCategory: string
  categories: Category
  postDatas: PostItem[]
  setCategory: React.Dispatch<React.SetStateAction<string>>
}

export const useGetPosts = (): getPostsProps => {

  // ローディング状態切り替え
  const [isLoading, setIsLoading] = useState(true)

  // ニュースのカテゴリ。TabsSelectのクリックによって切り替わる。
  const [category, setCategory] = useState('top')

  // 取得してきた記事が格納される。カテゴリの切り替えと同時に切り替わる。
  const postDataKey: PostItem[] = []
  const [postDatas, setPosts] = useState(postDataKey)

  const loadPosts = () => {
    const fetch = async (): Promise<void> => {
      setIsLoading(true)
      const response = await createPosts(category)
      setPosts(response)
      setIsLoading(false)
    }

    fetch()
      .catch((error: Error) => {
        console.error(error.message)
      })
  }

  useEffect(loadPosts, [category])

  const categories: Category = {
    top: 'top',
    new: 'new',
    best: 'best'
  }

  var textCategory = categories[category]
  return { isLoading, textCategory, categories, postDatas, setCategory }
}
