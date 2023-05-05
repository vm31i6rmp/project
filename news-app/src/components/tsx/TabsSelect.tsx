import React from 'react'
import Tabs from '@mui/material/Tabs'
import Tab from '@mui/material/Tab'
import { Category } from '../hooks/interface'

interface TabProps {
  selectTab: string
  setSelectTab: React.Dispatch<React.SetStateAction<string>>
  tabsCategories: Category
}

const TabsSelect: React.FC<TabProps> = ({ selectTab, setSelectTab, tabsCategories }) => {
  const clickTab = (event: React.SyntheticEvent, newTab: string): void => {
    setSelectTab(newTab)
  }

  return (
    <Tabs value={selectTab} onChange={clickTab} variant='fullWidth' sx={{
      width: '100%',
      borderBottom: '1px solid black'
    }}>
      {
        Object.keys(tabsCategories).map(key => {
          return (
            <Tab key={key} label={tabsCategories[key]} value={key} />
          )
        })
      }
    </Tabs>
  )
}

export default TabsSelect
