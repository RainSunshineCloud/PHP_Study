<style scoped>
    .layout{
        border: 1px solid #d7dde4;
        background: #f5f7f9;
        position: relative;
        border-radius: 4px;
        overflow: hidden;
    }
    .layout-nav{
        width: 420px;
        margin: 0 auto;
    }
    .layout-footer-center{
        text-align: center;
    }
</style>
<template>
    <div class="layout">
        <Layout>
            <Header :style="{position: 'fixed', width: '100%'}">
                <Menu mode="horizontal" theme="dark" active-name="1" @on-select="router">
                    <div class="layout-nav">
                            <MenuItem name="blog" >
                                <Icon type="ios-navigate"></Icon>
                                博文
                            </MenuItem>
                            <MenuItem name="communication">
                                <Icon type="ios-keypad"></Icon>
                                交流
                            </MenuItem>
                            <MenuItem name="friends">
                                <Icon type="ios-analytics"></Icon>
                                好友
                            </MenuItem>
                            <MenuItem name="project">
                                <Icon type="ios-paper"></Icon>
                                项目
                            </MenuItem>
                    </div>
                </Menu>
            </Header>
            <Content :style="{margin: '88px 20px 0', background: '#fff', minHeight: '500px'}">
                <router-view/>
            </Content>
            <Footer class="layout-footer-center">2011-2016 &copy; TalkingData</Footer>
        </Layout>
    </div>
</template>
<script>
    export default {
        methods: {
            router (name) {
               this.$router.push({name:name});  
            }
        }
    }
</script>
