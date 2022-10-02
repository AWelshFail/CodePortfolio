import React from 'react';
import { FlatList, StyleSheet, View } from 'react-native';

import colors from '../config/colors';
import ListItem from '../components/ListItem';
import Screen from '../components/Screen';
import Icon from '../components/Icon';
import ListItemSeparator from '../components/ListItemSeparator';

const menuItems = [
    {
        title: "My Listing",
        icon: {
            name: "format-list-bulleted",
            backgroundColor: colors.primary
        }
    },
    {
        title: "My Messages",
        icon: {
            name: "email",
            backgroundColor: colors.secondary
        }
    }
]

function MyAccountScreen(props) {
    return (
        <Screen style={styles.Screen}>
            <View style={styles.container}>
                <ListItem 
                title="Edward Meek"
                subTitle="fakeWebAddress@fake.com"
                image={require('../assets/mosh.jpg')}/>
            </View>
            <View style={styles.container}>
                <FlatList 
                    data={menuItems}
                    keyExtractor={(menuItem) => menuItem.title}
                    renderItem={({ item }) => (
                    <ListItem 
                        title={item.title}
                        IconComponent={
                            <Icon name={item.icon.name} backgroundColor={item.icon.backgroundColor}/>
                        }
                    />)
                                     
                    }
                    ItemSeparatorComponent={ListItemSeparator}
                    />
            </View>
            <ListItem
            title="Log Out"
            IconComponent={
                <Icon name="logout" backgroundColor="#ffe66d" />
            }/>
        </Screen>
    );
}

const styles = StyleSheet.create({
    container: {
        marginVertical: 20,
    },
    Screen: {
        backgroundColor: colors.lightG
    }
})

export default MyAccountScreen;