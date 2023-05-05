import React, { useState } from 'react'
import Box from '@mui/material/Box'
import TabsSelect from './TabsSelect'
import { useGetPosts } from '../hooks/useGetPost'
import NewsLists from './NewsLists'

const Main: React.FC = () => {
  const { textCategory, categories, postDatas, isLoading, setCategory } = useGetPosts()
  return (
    <Box pt={5} m={'0 auto'} width={'100%'} maxWidth={800}>
      <TabsSelect selectTab={textCategory} setSelectTab={setCategory} tabsCategories={categories} />
      <NewsLists isLoading={isLoading} postDatas={postDatas} />
    </Box>
  )
}

export default Main
