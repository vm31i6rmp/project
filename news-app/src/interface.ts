export interface TabCategoryType {
    name: string
    display: string
  }
export interface HackerNewsType {
  by: string
  descendants: number
  id: string
  kids: number[]
  score: number
  time: number
  title: string
  type: string
  url: string
}